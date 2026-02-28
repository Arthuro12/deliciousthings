<?php

namespace App\Http\Controllers\Api\Addresses;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\GeocodingClient;

class AutocompleteController extends Controller
{
    public function __construct(private GeocodingClient $geocodingClient)
    {}

    public function __invoke(Request $request)
    {
        $text = $request->query('text');
        $suggestions = [];
        
        try {
            $suggestions = $this->geocodingClient->autocomplete($text);

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