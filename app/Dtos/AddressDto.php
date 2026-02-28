<?php

namespace App\Dtos;

class AddressDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $street, 
        public string $house_number,
        public string $city,
        public string $country,
        public ?string $postal_code = null,
        public ?string $address_line_2 = null,
        public ?float $lat = null,
        public ?float $lon = null,
        public ?string $formatted = null,
        public ?bool $shows_full_address = null,
    ) {
        //
    }
}