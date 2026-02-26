<?php

namespace App\Http\Controllers\Api\Addresses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

class AutocompleteController extends Controller
{
    final const API_END_POINT = 'https://api.geoapify.com/v1/geocode/autocomplete';

    public function __construct()
    {}

    public function __invoke(Request $request)
    {
        $text = $request->query('text');
        $suggestions = [];
        
        try {
            $response = Http::acceptJson()->get(self::API_END_POINT, [
                'text' => $text,
                'format' => 'json',
                'lang' => 'de',
                'limit' => 7,
                'apiKey' => config('services.geoapify.key'),
            ]);
            $suggestions = array_map(function ($item) {
                return $item['formatted'];
            }, $response->json('results'));

        } catch (HttpException $e) {
            $context = [
                'code' => $e->getCode(),
                'error' => $e->getMessage(),
            ];
            Log::error('Error occurred while searching for address suggestions', $context);
            return response()->json($context);
        }

        return response()->json([
            'data' => $suggestions,
        ]);
    }
}