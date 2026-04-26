<?php

Namespace App\Actions;

use Illuminate\Support\Facades\DB;

class FillBakedGoods 
{
    final const BAKED_GOODS = [
        'breads_and_rolls' => [
            [
                'key'   => 'bread',
                'name'  => 'Bread',
                'label' => 'Brot',
            ],
            [
                'key'   => 'sourdough-bread',
                'name'  => 'Sourdough bread',
                'label' => 'Sauerteigbrot',
            ],
            [
                'key'   => 'whole-wheat-bread',
                'name'  => 'Whole wheat bread',
                'label' => 'Vollkornbrot',
            ],
            [
                'key'   => 'baguette',
                'name'  => 'Baguette',
                'label' => 'Baguette',
            ],
            [
                'key'   => 'bagels',
                'name'  => 'Bagels',
                'label' => 'Bagels',
            ],
            [
                'key'   => 'rolls',
                'name'  => 'Rolls',
                'label' => 'Brötchen',
            ],
            [
                'key'   => 'ciabatta',
                'name'  => 'Ciabatta',
                'label' => 'Ciabatta',
            ],
            [
                'key'   => 'focaccia',
                'name'  => 'Focaccia',
                'label' => 'Focaccia',
            ],
            [
                'key'   => 'pretzel',
                'name'  => 'Pretzel',
                'label' => 'Brezel',
            ],
        ],
        'pastries' => [
            [
                'key'   => 'cake',
                'name'  => 'Cake',
                'label' => 'Kuchen',
            ],
            [
                'key'   => 'tart',
                'name'  => 'Tart',
                'label' => 'Torte',
            ],
            [
                'key'   => 'cheesecake',
                'name'  => 'Cheesecake',
                'label' => 'Käsekuchen',
            ],
            [
                'key'   => 'cupcake',
                'name'  => 'Cupcake',
                'label' => 'Cupcake',
            ],
            [
                'key'   => 'brownies',
                'name'  => 'Brownies',
                'label' => 'Brownies',
            ],
            [
                'key'   => 'cookies',
                'name'  => 'Cookies',
                'label' => 'Cookies',
            ],
        ],
        'viennoiseries' => [
            [
                'key'   => 'croissant',
                'name'  => 'Croissant',
                'label' => 'Croissant',
            ],
            [
                'key'   => 'chocolatine',
                'name'  => 'Chocolatine',
                'label' => 'Chocolatine',
            ],
            [
                'key'   => 'pain-au-chocolat',
                'name'  => 'Pain au chocolat',
                'label' => 'Pain au chocolat',
            ],
            [
                'key'   => 'cinnamon-roll',
                'name'  => 'Cinnamon roll',
                'label' => 'Zimtschnecke',
            ],
        ],
        'chocolate' => [
            [
                'key'   => 'praline',
                'name'  => 'Praline',
                'label' => 'Praline',
            ],
        ],
        'fried_sweet_pastries' => [
            [
                'key'   => 'berliner',
                'name'  => 'Berliner',
                'label' => 'Berliner',
            ],
            [
                'key'   => 'donuts',
                'name'  => 'Donuts',
                'label' => 'Donuts',
            ],
            [
                'key'   => 'churros',
                'name'  => 'Churros',
                'label' => 'Churros',
            ],
        ],
    ];

    public function handle(): void
    {
        foreach (self::BAKED_GOODS as $category => $goods) {
            $totalGoods = count($goods);
            for ($i = 0; $i < $totalGoods; $i++) {
                DB::table('baked_goods')->updateOrInsert(
                    [ 
                        'key' => $goods[$i]['key'] 
                    ],
                    [
                        'category' => $category, 
                        ...$goods[$i],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }
    }
}