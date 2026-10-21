<?php

namespace App\Http\Controllers\Artisan;

use Inertia\Inertia;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use App\Services\ArtisanService;
use Illuminate\Support\Facades\Storage;

class PublicProfileController extends Controller
{
    public function __construct(private ArtisanService $artisanService) 
    {}

    public function show(Artisan $artisan)
    {
        $profile = $this->artisanService->getProfile($artisan, ['bakedGoods', 'dietaryOptions', 'services']);
        $profile['profile_photo'] = $this->artisanService->getProfilePhoto($artisan);
        $profile['gallery'] = [...$this->artisanService->getGallery($artisan)];
        $profile['creations'] = $artisan->creations()
            ->where('is_published', true)
            ->with('medias')
            ->latest()
            ->get()
            ->map(fn ($creation) => [
                'id' => $creation->id,
                'title' => $creation->title,
                'description' => $creation->description,
                'price' => $creation->price,
                'price_on_request' => $creation->price_on_request,
                'photos' => $creation->medias->map(fn ($media) => Storage::url($media->path)),
            ]);

        return Inertia::render('artisan/ShowArtisan', [
            'artisan' => $profile,
        ]);
    }
}
