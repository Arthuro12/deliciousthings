<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Artisan;

class SearchController extends Controller
{
    function __invoke(Request $request)
    {
        $request->validate([
            'goods' => 'required|string',
            'dietary_options' => 'nullable|string',
            'min_price' => 'nullable|string',
            'max_price' => 'nullable|string',
            'offers_delivery' => 'nullable|boolean',
            'pick_up_on_site' => 'nullable|boolean',
        ]);

        $results = [];
        $selectedGoods = explode(",", $request->query('goods'));
        $selectedDietaryOptions = explode(",", $request->query('dietary_options'));
        $artisans = Artisan::whereHas('bakedGoods', function ($query) use ($selectedGoods) {
                $query->whereIn('key', $selectedGoods);
            })
            ->when($request->has('dietary_options'), function ($query) use ($selectedDietaryOptions) {
                $query->whereHas('dietaryOptions', function ($query) use ($selectedDietaryOptions) {
                    $query->whereIn('key', $selectedDietaryOptions);
                });
            });
            //->get();
        
        // if ($request->has('min_price')) {
        //     $artisans->where('average_rate', '>=', (int) $request->query('min_price'));
        // }
        // if ($request->has('max_price')) {
        //     $artisans->where('average_rate', '<=', (int) $request->query('max_price'));
        // }
        if ($request->has('offers_delivery')) {
            $artisans->where('offers_delivery', $request->query('offers_delivery'));
        }
        if ($request->has('pick_up_on_site')) {
            $artisans->where('pick_up_on_site', $request->query('pick_up_on_site'));
        }
        dd($artisans->count());

        $results = $artisans->get();
        return Inertia::render('Search/Index', [
            'artisans' => $results,
        ]);
    }
}