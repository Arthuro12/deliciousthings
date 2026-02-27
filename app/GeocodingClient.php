<?php

namespace App;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

use App\Dtos\AddressDto;

class GeocodingClient
{
    final const BASE_URL = 'https://api.geoapify.com/v1/geocode';

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function autocomplete(string $address): array
    {
        try {
            $url = self::BASE_URL . '/autocomplete';
            $response = Http::acceptJson()->get($url, [
                'text' => $address,
                'format' => 'json',
                'lang' => 'de',
                'limit' => 7,
                'apiKey' => config('services.geoapify.key'),
            ]);

            $suggestions = array_map(function ($item) {
                return $item['formatted'];
            }, $response->json('results'));
            return $suggestions;
        } catch (HttpException $e) {
            throw new HttpException($e->getCode(), $e->getMessage());
        }
    }

    public function geocode(AddressDto $address): array
    {
        try {
            $url = self::BASE_URL . '/search';
            $response = Http::acceptJson()->get($url, [
                'street' => $address->street,
                'house_number' => $address->house_number,
                'postcode' => $address->postal_code,
                'city' => $address->city,
                'country' => $address->country,
                'format' => 'json',
                'lang' => 'de',
                'limit' => 1,
                'apiKey' => config('services.geoapify.key'),
            ]);


            $match = $response->json('results')[0];
            return $match;
        } catch (HttpException $e) {
            throw new HttpException($e->getCode(), $e->getMessage());
        }
    }
}