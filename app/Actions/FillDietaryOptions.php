<?php

namespace App\Actions;

use App\Models\DietaryOption;

class FillDietaryOptions
{
    final const DIETARY_OPTIONS = [
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
        [
            'key' => 'bio-organic',
            'name' => 'organic-sustainable',
            'label' => 'bio / nachhaltig'
        ],
    ];

    public function handle(): void
    {
        foreach (self::DIETARY_OPTIONS as $option) {
            DietaryOption::updateOrCreate([
                'key' => $option,
            ], $option);
        }
    }
}