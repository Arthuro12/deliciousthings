<?php

namespace App\Enums;

enum AddressVisibility: string
{
    case Public = 'public';
    case Private = 'private';
    case City = 'city';

}