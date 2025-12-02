<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Artisan;
use App\Models\Speciality;
use App\Http\Requests\CreateProfileRequest;

class ProfileController extends Controller
{
    public function create()
    {
        return Inertia::render('profile/CreateProfile');
    }

    public function show(User $user, Artisan $artisan)
    {
        $artisan = $artisan->load(['specialities'])->toArray();

        return Inertia::render('profile/ShowProfile', [
            'artisan' => $artisan,
        ]);
    }

    public function store(CreateProfileRequest $request, User $user)
    {
        $attrs = $request->validated();

        $artisan = new Artisan([
            'username' => $attrs['username'],
            'company_name' => $attrs['company_name'],
            'e164phone' => $attrs['e164phone'],
            'email' => $attrs['email'],
            'biography' => $attrs['biography'],
            'website_url' => $attrs['website_url'],
            'instagram_url' => $attrs['instagram_url'],
            'average_rate' => $attrs['average_rate'],
            'offers_delivery' => $attrs['offers_delivery'],
        ]);
        $artisan = $user->artisan()->save($artisan);

        $selectedSpecialies = array_map(function ($value) {
            return $value['key'];
        }, $attrs['specialities']);
        $specialities = Speciality::whereIn('key', $selectedSpecialies)->get();
        foreach ($specialities as $speciality) {
            $artisan->specialities()->attach($speciality->id);
        }

        foreach ($request->file('gallery') as $image) {
            $path = $image->storePublicly('gallery');
            $artisan->medias()->create([
                'category' => 'gallery',
                'path' => $path
            ]);
        }

        $artisan->addresses()->create([
            'street' => $attrs['first_address']['street'],
            'house_number' => $attrs['first_address']['house_number'],
            'postal_code' => $attrs['first_address']['postal_code'],
            'city' => $attrs['first_address']['city'],
            'country' => $attrs['first_address']['country'],
            'address_line_2' => $attrs['first_address']['address_line_2'],
        ]);

        // return back()->withError();
        // redirect("/");
    }
}
