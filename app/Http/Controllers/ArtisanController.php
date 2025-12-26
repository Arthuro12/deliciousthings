<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

use App\Models\Artisan;
use App\Models\Speciality;
use App\Models\DietType;
use App\Http\Requests\CreateArtisanRequest;
use App\Services\ArtisanService;

class ArtisanController extends Controller
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

        $profile = $this->artisanService
            ->getProfile($artisan, ['specialities', 'dietTypes']);
        $gallery = $this->artisanService->getGallery($artisan);

        return Inertia::render('artisan/EditArtisan', [
            'artisan' => $profile,
            'gallery' => $gallery
        ]);
    }

    public function show(Request $request)
    {
        $artisan = $request->user()->artisan;
        if (is_null($artisan)) {
            return to_route('artisan.profile.create')->with('info', __('No existing profile.'));
        }

        $profile = $this->artisanService
            ->getProfile($artisan, ['specialities', 'dietTypes']);
        $gallery = $this->artisanService->getGallery($artisan);

        return Inertia::render('artisan/ShowArtisan', [
            'artisan' => $profile,
            'gallery' => $gallery,
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

        if (!empty($attrs['diet_types'])) {
            $selectedDietTypes = array_map(function ($value) {
                return $value['key'];
            }, $attrs['diet_types']);
            $dietTypes = DietType::whereIn('key', $selectedDietTypes)->get();
            foreach ($dietTypes as $type) {
                $artisan->dietTypes()->attach($type->id);
            }
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

        Log::notice("Artisan profile successfully created!");
        
        return to_route('artisan.profile.show')->with('success', __('Your profile has been successfully created.'));
    }

    public function update(CreateArtisanRequest $request)
    {
        /**
         * 1. Mettre à jours les données du modèle artisan
         * 2. Créer les nouvelles photos uploadés
         * 3. Mettre à jour les spécialités
         * 4. Mettre à jour les types de régime alimentaire choisis
         *      - Vérifier si les spécialités et types de régime alimentaire actuells 
         *      Sont présents dans nouvelle sélection:
         *          - Si oui: Aucune action
         *          - Si non: Supprimés les spécialités et types de régime alimentaire avant
         *          d'ajouter les nouvelles
         * 5. Mettre à jour l'adresse du profil:
         *      - Si le profil a actuellement une adresse et que l'adresse n'est pas inclue dans le payload de la requête:
         *          Supprimer l'adresse;
         *      - Sinon: juste mettre à jour l'adresse
         *      - Si le profil n'avait 
         *      aucune adresse et que l'addresse est soumise: Créer l'adresse;
         */
        
    }
}