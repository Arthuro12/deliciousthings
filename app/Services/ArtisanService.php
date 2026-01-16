<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

use App\Models\Artisan;

class ArtisanService 
{
    /**
     * Returns the artisan profile data.
     */
    public function getProfile(Artisan $artisan, array $relations = [])
    {
        return $artisan->load($relations)->toArray();
    }

    /**
     * Returns the profile photo gallery.
     */
    public function getGallery(Artisan $artisan): array
    {
        $medias = $artisan->medias->toArray();
        $galleryMedias = Arr::where($medias, function ($value) {
            return $value['category'] == 'gallery';
        });
        $gallery = [];
        foreach ($galleryMedias as $key => $media) {
            $gallery[$key]['id'] = $media['id'];
            $gallery[$key]['url'] = Storage::url($media['path']);
        } 

        return $gallery;
    }

    /**
     * Returns the artisan's profile photo if he/she has one.
     */
    public function getProfilePhoto(Artisan $artisan): array|null
    {
        if (is_null($artisan->profilePhoto())) {
            return null;
        }

        return [
            'id' => $artisan->profilePhoto()->id,
            'url' => Storage::url($artisan->profilePhoto()->path),
        ];
    }
}