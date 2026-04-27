<?php

Namespace App\Actions;

use Illuminate\Support\Facades\DB;

class FillServices 
{
    final const SERVICES = [
        'pastry_shop' => [
            [
                'key'   => 'cake-design',
                'name'  => 'cake design',
                'label' => 'Tortendesign',
            ],
            [
                'key'   => 'wedding-cakes',
                'name'  => 'wedding cakes',
                'label' => 'Hochzeitstorten',
            ],
            [
                'key'   => 'birthday-cakes',
                'name'  => 'birthday cakes',
                'label' => 'Geburtstagstorten',
            ],
            [
                'key'   => 'custom-cake',
                'name'  => 'custom cake',
                'label' => 'Personalisierte Torten',
            ],
        ],
        'bakery' => [
            [
                'key'   => 'breakfast-menu',
                'name'  => 'breakfast menu',
                'label' => 'Frühstücksangebote',
            ],
            [
                'key'   => 'snack-menu',
                'name'  => 'snack menu',
                'label' => 'Scnackangebote',
            ],
            [
                'key'   => 'sandwiches',
                'name'  => 'sandwiches',
                'label' => 'Belegte Brötchen / Sandwiches',
            ],
        ],
    ];

    public function handle(): void
    {
        foreach (self::SERVICES as $category => $services) {
            $totalServices = count($services);
            for ($i = 0; $i < $totalServices; $i++) {
                DB::table('services')->updateOrInsert(
                    ['key' => $services[$i]['key']],
                    [
                        'category' => $category, 
                        ...$services[$i],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }
    }
}