<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Artisan;
use App\Models\Speciality;
use App\Models\DietType;
use App\Http\Requests\CreateArtisanRequest;

class ArtisanController extends Controller
{
    public function create()
    {
        return Inertia::render('artisan/CreateArtisan');
    }

    public function show(Request $request)
    {
        if (is_null($request->user()->artisan)) {
            return to_route('artisan.profile.create')->with('info', __('No existing profile.'));
        }

        $profile = $request->user()->artisan->load([
            'specialities', 
            'dietTypes', 
            'medias', 
        ])->toArray();

        $gallery = [];
        $galleryMedias = Arr::where($profile['medias'], function ($value) {
            return $value['category'] == 'gallery';
        });
        foreach ($galleryMedias as $key => $file) {
            $gallery[$key]['url'] = Storage::url($file['path']);
        }

        return Inertia::render('artisan/ShowArtisan', [
            'artisan' => $profile,
            'gallery' => $gallery,
        ]);
    }

    public function store(CreateArtisanRequest $request)
    {
        $attrs = $request->validated();

        $user = $request->user();

        $artisan = new Artisan([
            'name' => $attrs['name'],
            'company_name' => $attrs['company_name'],
            'main_occupation' => $attrs['main_occupation'],
            'e164phone' => $attrs['e164phone'],
            'email' => $attrs['email'],
            'short_description' => $attrs['short_description'],
            'about' => $attrs['about'],
            'website_url' => $attrs['website_url'],
            'instagram_url' => $attrs['instagram_url'],
            'average_rate' => $attrs['average_rate'],
            'offers_delivery' => $attrs['offers_delivery'],
            'pick_up_on_site' => $attrs['pick_up_on_site'],
        ]);
        $artisan = $user->artisan()->save($artisan);

        $selectedSpecialities = array_map(function ($value) {
            return $value['key'];
        }, $attrs['specialities']);
        $specialities = Speciality::whereIn('key', $selectedSpecialities)->get();
        foreach ($specialities as $speciality) {
            $artisan->specialities()->attach($speciality->id);
        }

        $selectedDietTypes = array_map(function ($value) {
            return $value['key'];
        }, $attrs['diet_types']);
        $dietTypes = DietType::whereIn('key', $selectedDietTypes)->get();
        foreach ($dietTypes as $type) {
            $artisan->dietTypes()->attach($type->id);
        }

        foreach ($request->file('gallery') as $image) {
            $path = $image->storePublicly('gallery', 'public');
            $artisan->medias()->create([
                'category' => 'gallery',
                'path' => $path
            ]);
        }

        $hasRequiredAddressFields = Arr::every($attrs['first_address'], function ($value, $key) {
            if ($key == 'address_line_2') {
                return true;
            }
            return !is_null($value);
        });
        if ($hasRequiredAddressFields) {
            $artisan->addresses()->create([
                'street' => $attrs['first_address']['street'],
                'house_number' => $attrs['first_address']['house_number'],
                'postal_code' => $attrs['first_address']['postal_code'],
                'city' => $attrs['first_address']['city'],
                'country' => $attrs['first_address']['country'],
                'address_line_2' => $attrs['first_address']['address_line_2'],
            ]);
        }

        Log::notice("Artisan profile successfully created");
        
        return to_route('artisan.profile.show')->with('success', __('Your profile has been successfully created.'));;
    }
}