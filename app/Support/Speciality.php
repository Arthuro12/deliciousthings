<?php

namespace App\Support;

use App\Models\Speciality as SpecialityModel;

class Speciality
{
    final const SPECIALITIES = [
        [
            'key' => 'pies',
            'name' => 'pies',
            'label' => 'Torten'
        ],
        [
            'key' => 'cake',
            'name' => 'cake',
            'label' => 'Kuchen'
        ],
        [
            'key' => 'pastries',
            'name' => 'pastries',
            'label' => 'Gebäck'
        ],
        [
            'key' => 'chocolate',
            'name' => 'chocolate',
            'label' => 'Schokolade'
        ],
        [
            'key' => 'bread',
            'name' => 'bread',
            'label' => 'Brot'
        ],
        [
            'key' => 'rolls',
            'name' => 'rolls',
            'label' => 'Brötchen'
        ],
        [
            'key' => 'ice-cream',
            'name' => 'ice cream',
            'label' => 'Eiscreme'
        ],
    ];

    /**
     * Fills in the specialities table.
     * 
     * @return void
     */
    static public function fill()
    {
        foreach (self::SPECIALITIES as $speciality) {
            SpecialityModel::create($speciality);
        }
    }
}