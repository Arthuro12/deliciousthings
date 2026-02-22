<?php

namespace App\Enums;

enum PriceLevel: string
{
    case Inexpensive = 'inexpensive';
    case Moderate = 'moderate';
    case HigherEnd = 'higher-end';

    public function symbol() 
    {
        return match($this) {
            PriceLevel::Inexpensive => '€',
            PriceLevel::Moderate => '€€',
            PriceLevel::HigherEnd => '€€€',
            default => '',
        };
    }

    public static function fromPrice(int $price) 
    {
        return match(true) {
            $price <= 15 => PriceLevel::Inexpensive,
            $price <= 30 => PriceLevel::Moderate,
            $price > 60 => PriceLevel::HigherEnd,
            default => PriceLevel::HigherEnd,
        };
    }
}