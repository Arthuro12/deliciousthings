<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\Artisan;
use App\Services\ArtisanService;

class SearchController extends Controller
{
    public function __construct(private ArtisanService $artisanService) 
    {}

    public function index(Request $request)
    {
        $attrs = $request->validate([
            'goods' => 'nullable|string',
            'dietary_options' => 'nullable|string',
            'price_levels' => 'nullable|string',
            'offers_delivery' => 'nullable|boolean',
            'pick_up_on_site' => 'nullable|boolean',
            'lat' => 'nullable|numeric',
            'lon' => 'nullable|numeric',
            'radius' => 'nullable|string',
        ]);

        $results = [];
        $artisans = Artisan::with(['bakedGoods', 'dietaryOptions']);

        if ($request->has('goods')) {
            $goods = explode(",", $request->query('goods'));
            $artisans->when(count($goods) > 0, function ($query) use ($goods) {
                $query->whereHas('bakedGoods', function ($query) use ($goods) {
                    $query->whereIn('key', $goods);
                });
            });
        }

        if ($request->has('dietary_options')) {
            $dietaryOptions = explode(",", $request->query('dietary_options'));
            $artisans->when(count($dietaryOptions) > 0, function ($query) use ($dietaryOptions) {
                $query->whereHas('dietaryOptions', function ($query) use ($dietaryOptions) {
                    $query->whereIn('key', $dietaryOptions);
                });
            });
        }

        if ($request->has('price_levels')) {
            $priceLevels = explode(',', $request->query('price_levels'));
            $artisans->whereIn('price_level', $priceLevels);
        }

        if ($request->query('offers_delivery')) {
            $artisans->where(function ($query) {
                $query->where('offers_delivery', true);
            });
        }

        if ($request->query('pick_up_on_site')) {
            $artisans->where(function ($query) {
                $query->where('pick_up_on_site', true);
            });
        }

        if ($request->has('lat') && $request->has('lon') && $request->has('radius')) {
            $artisans->distance(
                distance: intval(json_decode($request->query('radius'))), 
                lat: floatval($request->query('lat')),
                lng: floatval($request->query('lon')),
            );
        }
        
        $collections = $artisans->get()->map(function (Artisan $collection) {
            $collection['profile_photo'] = $this->artisanService->getProfilePhoto($collection);
            return $collection;
        });

        $results = $collections->toArray();
        return Inertia::render('search/Index', [
            'artisans' => $results,
        ]);
    }
}