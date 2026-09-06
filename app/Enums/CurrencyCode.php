<?php

namespace App\Enums;

enum CurrencyCode: string
{
    case Eur = 'EUR';
    case Usd = 'USD';
    case Gbp = 'GBP';
    case Chf = 'CHF';
}