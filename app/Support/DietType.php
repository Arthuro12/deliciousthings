<?php

namespace App\Support;

use App\Models\DietType as DietTypeModel;

class DietType
{
    final const DIET_TYPES = [
        [
            'key' => 'vegan',
            'name' => 'vegan',
            'label' => 'vegan'
        ],
        [
            'key' => 'gluten-free',
            'name' => 'gluten-free',
            'label' => 'glutenfrei'
        ],
        [
            'key' => 'lactose-free',
            'name' => 'lactose-free',
            'label' => 'laktosefrei'
        ],
        [
            'key' => 'sugar-free',
            'name' => 'sugar-free',
            'label' => 'zuckerfrei'
        ],
    ];

    /**
     * Fills in the specialities table.
     * 
     * @return void
     */
    static public function fill()
    {
        foreach (self::DIET_TYPES as $dietType) {
            DietTypeModel::create($dietType);
        }
    }
}