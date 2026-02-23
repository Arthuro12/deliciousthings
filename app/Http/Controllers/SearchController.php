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

    public function __invoke(Request $request)
    {
        $request->validate([
            'goods' => 'required|string',
            'dietary_options' => 'nullable|string',
            'price_levels' => 'nullable|string',
            'offers_delivery' => 'nullable|boolean',
            'pick_up_on_site' => 'nullable|boolean',
        ]);

        $results = [];

        $goods = explode(",", $request->query('goods'));
        $artisans = Artisan::whereHas('bakedGoods', function ($query) use ($goods) {
            $query->whereIn('key', $goods);
        });

        $dietaryOptions = [];
        if ($request->has('dietary_options')) {
            $dietaryOptions = explode(",", $request->query('dietary_options'));
        }
        $artisans->when(count($dietaryOptions) > 0, function ($query) use ($dietaryOptions) {
            $query->whereHas('dietaryOptions', function ($query) use ($dietaryOptions) {
                $query->whereIn('key', $dietaryOptions);
            });
        });

        if ($request->has('price_levels')) {
            $priceLevels =explode(',', $request->query('price_levels'));
            $artisans->whereIn('price_level', $priceLevels);
        }
        if ($request->has('offers_delivery')) {
            $artisans->where('offers_delivery', $request->query('offers_delivery'));
        }
        if ($request->has('pick_up_on_site')) {
            $artisans->where('pick_up_on_site', $request->query('pick_up_on_site'));
        }
        
        $collections = $artisans->get()->map(function ($collection) {
            $collection['profile_photo'] = $this->artisanService->getProfilePhoto($collection);
            return $collection;
        });

        $results = $collections->toArray();
        return Inertia::render('search/Index', [
            'artisans' => $results,
        ]);
    }
}