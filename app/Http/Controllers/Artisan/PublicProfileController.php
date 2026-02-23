<?php

namespace App\Http\Controllers\Artisan;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use App\Services\ArtisanService;

class PublicProfileController extends Controller
{
    public function __construct(private ArtisanService $artisanService) 
    {}

    public function show(Artisan $artisan)
    {
        $profile = $this->artisanService->getProfile($artisan, ['bakedGoods', 'dietaryOptions']);
        $profile['profile_photo'] = $this->artisanService->getProfilePhoto($artisan);
        $profile['gallery'] = [...$this->artisanService->getGallery($artisan)];

        return Inertia::render('artisan/ShowArtisan', [
            'artisan' => $profile,
        ]);
    }
}