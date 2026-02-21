<?php

namespace App\Http\Controllers\Artisan;

use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Artisan;
use App\Models\Media;
use App\Models\BakedGood;
use App\Models\DietaryOption;
use App\Models\Address;
use App\Http\Requests\CreateArtisanRequest;
use App\Mail\MessageSent;
use App\Services\ArtisanService;

class ProfileController extends Controller
{

    public function __construct(
        public ArtisanService $artisanService,
    ) {}

    public function create()
    {
        return Inertia::render('artisan/CreateArtisan');
    }

    public function edit(Request $request)
    {
        $artisan = $request->user()->artisan;

        $profilePhoto = $this->artisanService->getProfilePhoto($artisan);
        $profile = $this->artisanService
            ->getProfile($artisan, ['bakedGoods', 'dietaryOptions']);
        $gallery = $this->artisanService->getGallery($artisan);

        return Inertia::render('artisan/EditArtisan', [
            'artisan' => $profile,
            'profile_photo' => $profilePhoto,
            'gallery' => [...$gallery],
        ]);
    }

    public function show(Request $request)
    {
        $artisan = $request->user()->artisan;
        if (is_null($artisan)) {
            return to_route('artisan.profile.create')->with('info', __('No existing profile.'));
        }

        
        $profilePhoto = $this->artisanService->getProfilePhoto($artisan);
        $profile = $this->artisanService
            ->getProfile($artisan, ['bakedGoods', 'dietaryOptions']);
        $gallery = $this->artisanService->getGallery($artisan);

        return Inertia::render('artisan/ShowArtisan', [
            'artisan' => $profile,
            'profile_photo' => $profilePhoto,
            'gallery' => [...$gallery],
        ]);
    }

    public function store(CreateArtisanRequest $request)
    {
        $attrs = $request->validated();
        $user = $request->user(); // Stores the request author to keep it up to date. 

        $artisan = new Artisan([
            'name' => $attrs['name'],
            'company_name' => $attrs['company_name'],
            'main_occupation' => $attrs['main_occupation'],
            'short_description' => $attrs['short_description'],
            'about' => $attrs['about'],
            'website_url' => $attrs['website_url'],
            'instagram_url' => $attrs['instagram_url'],
            'average_rate' => $attrs['average_rate'],
            'offers_delivery' => $attrs['offers_delivery'],
            'pick_up_on_site' => $attrs['pick_up_on_site'],
        ]);
        $artisan = $user->artisan()->save($artisan);

        $selectedGoods = Arr::map($attrs['baked_goods'], function ($value) {
            return $value['key'];
        });
        $goods = BakedGood::whereIn('key', $selectedGoods)->get();
        foreach ($goods as $good) {
            $artisan->bakedGoods()->attach($good->id);
        }

        if (!empty($attrs['dietary_options'])) {
            $selectedDietaryOptions = Arr::map($attrs['dietary_options'], function ($value) {
                return $value['key'];
            });
            $dietaryOptions = DietaryOption::whereIn('key', $selectedDietaryOptions)->get();
            foreach ($dietaryOptions as $option) {
                $artisan->dietaryOptions()->attach($option->id);
            }
        }

        foreach ($request->file('gallery') as $photo) {
            $path = $photo->storePublicly('gallery', 'public');
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

        Log::notice("Artisan profile successfully created!");
        
        return to_route('artisan.profile.show')->with('success', __('Your profile has been successfully created.'));
    }

    public function deleteAddress(Request $request, Address $address)
    {
        $request->user()->artisan->addresses()->find($address->id)->delete();

        return back()->with('success', 'Address successfully deleted.');
    }

    public function deletePhoto(Request $request, Media $media)
    {
        $photo = $request->user()->artisan->medias()->find($media->id);
        if (is_null($photo)) {
            abort(403);
        }

        $galleryPhotoCount = $request->user()->artisan->medias()->where('category', 'gallery')->count();
        if ($galleryPhotoCount <= 3) {
            return back()->with('info', __('Make sure you have more than 3 photos before deleting the photo.'));
        }

        $photo->delete();
        Storage::disk('public')->delete($photo->path);

        return back()->with('success', 'Das Bild wurde gelöscht');
    }

    public function deleteProfilePhoto(Request $request, Media $media)
    {
        $photo = $request->user()->artisan->medias()->find($media->id);
        if (is_null($photo)) {
            abort(403);
        }

        $photo->delete();
        Storage::disk('public')->delete($photo->path);

        return back()->with('success', 'Das Profilbild wurde gelöscht');
    }

    public function storeAddress(Request $request, Address $address)
    {
        $attrs = $request->validate([
            'street' => 'required|string',
            'house_number' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'address_line_2' => 'nullable|string',
        ]);
        
        $request->user()->artisan->addresses()->create([
                'street' => $attrs['street'],
                'house_number' => $attrs['house_number'],
                'postal_code' => $attrs['postal_code'],
                'city' => $attrs['city'],
                'country' => $attrs['country'],
                'address_line_2' => $attrs['address_line_2'],
            ]   
        );

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function storeProfilePhoto(Request $request)
    {
        $attrs = $request->validate([
            'profile_photo' => File::image(),
        ]);

        $profilePhoto = $attrs['profile_photo'];
        $path = $profilePhoto->storePublicly('profile_photo', 'public');
        $request->user()->artisan->medias()->updateorCreate(
            ['category' => 'profile_photo'],
            ['path' => $path, 'category' => 'profile_photo']
        );

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function syncBakedGoods(Request $request)
    {
        $attrs = $request->validate([
            'baked_goods' => 'required|array',
            'baked_goods.*.key' => 'required|string',
            'baked_goods.*.name' => 'required|string',
            'baked_goods.*.label' => 'required|string',
        ]);
        
        $selectedBakedGoods = Arr::map($attrs['baked_goods'], function ($value) {
            return $value['key'];
        });
        $bakedGoodsIds = BakedGood::whereIn('key', $selectedBakedGoods)->pluck('id')->toArray();
        $request->user()->artisan->bakedGoods()->sync($bakedGoodsIds);

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function syncDietaryOptions(Request $request)
    {
        $attrs = $request->validate([
            'dietary_options' => 'required|array',
            'dietary_options.*.key' => 'required|string',
            'dietary_options.*.name' => 'required|string',
            'dietary_options.*.label' => 'required|string',
        ]);

        $selectedDietaryOptions = Arr::map($attrs['dietary_options'], function ($value) {
            return $value['key'];
        });
        $dietaryOptionIds = DietaryOption::whereIn('key', $selectedDietaryOptions)->pluck('id')->toArray();
        $request->user()->artisan->dietaryOptions()->sync($dietaryOptionIds);

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function updateAddress(Request $request, Address $address)
    {
        $attrs = $request->validate([
            'street' => 'required|string',
            'house_number' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'address_line_2' => 'nullable|string',
        ]);
        
        $request->user()->artisan->addresses()->find($address->id)->update([
                'street' => $attrs['street'],
                'house_number' => $attrs['house_number'],
                'postal_code' => $attrs['postal_code'],
                'city' => $attrs['city'],
                'country' => $attrs['country'],
                'address_line_2' => $attrs['address_line_2'],
            ]   
        );

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function updateBasicProfile(Request $request)
    {
        $attrs = $request->validate([
            'name' => 'required|string|min:5',
            'company_name' => 'nullable|string',
            'main_occupation' => 'nullable|string',
            'short_description' => 'nullable|string|max:200',
            'about' => 'required|string',
        ]);

        $request->user()->artisan->update([
            'name' => $attrs['name'],
            'company_name' => $attrs['company_name'],
            'main_occupation' => $attrs['main_occupation'],
            'short_description' => $attrs['short_description'],
            'about' => $attrs['about'],
        ]);

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function updateNetwork(Request $request)
    {   
        $attrs = $request->validate([
            'website_url' => 'nullable|string',
            'instagram_url' => 'nullable|string',
        ]);

        $request->user()->artisan->update([
            'website_url' => $attrs['website_url'],
            'instagram_url' => $attrs['instagram_url'],
        ]);
        
        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function updateServices(Request $request)
    {
        $attrs = $request->validate([
            'offers_delivery' => 'required|boolean',
            'pick_up_on_site' => 'required|boolean',
            'average_rate' => 'required|string',
        ]);

        $request->user()->artisan->update([
            'offers_delivery' => $attrs['offers_delivery'],
            'pick_up_on_site' => $attrs['pick_up_on_site'],
            'average_rate' => $attrs['average_rate'],
        ]);

        return back()->with('success', __('Artisan profile successfully updated.'));
    }

    public function uploadPhotos(Request $request)
    {
        $attrs = $request->validate([
            'gallery' => 'required',
            'gallery.*' => File::image(),
        ]);
        $uploadedPhotos = $attrs['gallery'];

        $galleryPhotoCount = $request->user()->artisan->medias()->where('category', 'gallery')->count();
        $maxPhotos = 6 - $galleryPhotoCount;
        if (count($uploadedPhotos) > $maxPhotos) {
            return back()->with('error', __('validation.gallery.max', ['max' => $maxPhotos]));
        }

        foreach($uploadedPhotos as $photo) {
            $path = $photo->storePublicly('gallery', 'public');
            $request->user()->artisan->medias()->create([
                'path' => $path,
                'category' => 'gallery'
            ]);
        }

        return back()->with('info', __('Artisan profile successfully updated.'));
    }
}