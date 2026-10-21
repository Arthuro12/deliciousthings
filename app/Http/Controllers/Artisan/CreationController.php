<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\Creation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Inertia\Inertia;

class CreationController extends Controller
{
    public function index(Request $request)
    {
        $artisan = $request->user()->artisan;
        abort_if(!$artisan, 403);

        return Inertia::render('artisan/Creations/Index', [
            'creations' => $artisan->creations()->with('medias')->latest()->get()->map(fn (Creation $creation) => $this->present($creation)),
        ]);
    }

    public function create(Request $request)
    {
        abort_if(!$request->user()->artisan, 403);

        return Inertia::render('artisan/Creations/Form', ['creation' => null]);
    }

    public function store(Request $request)
    {
        $artisan = $request->user()->artisan;
        abort_if(!$artisan, 403);

        $attrs = $this->validateCreation($request, true);
        $creation = $artisan->creations()->create(collect($attrs)->except('photos')->all());
        $this->storePhotos($creation, $request);

        return to_route('app.artisan.creations.index')->with('success', 'Deine Kreation wurde gespeichert.');
    }

    public function edit(Request $request, Creation $creation)
    {
        $creation = $this->ownedCreation($request, $creation);
        $creation->load('medias');

        return Inertia::render('artisan/Creations/Form', ['creation' => $this->present($creation)]);
    }

    public function update(Request $request, Creation $creation)
    {
        $creation = $this->ownedCreation($request, $creation);
        $attrs = $this->validateCreation($request, false);
        $creation->update(collect($attrs)->except('photos')->all());
        $this->storePhotos($creation, $request);

        return to_route('app.artisan.creations.index')->with('success', 'Deine Kreation wurde aktualisiert.');
    }

    public function togglePublication(Request $request, Creation $creation)
    {
        $creation = $this->ownedCreation($request, $creation);
        $creation->update(['is_published' => !$creation->is_published]);

        return back()->with('success', $creation->is_published ? 'Deine Kreation ist jetzt sichtbar.' : 'Deine Kreation wurde verborgen.');
    }

    public function destroy(Request $request, Creation $creation)
    {
        $creation = $this->ownedCreation($request, $creation);
        foreach ($creation->medias as $media) {
            Storage::disk('public')->delete($media->path);
            $media->delete();
        }
        $creation->delete();

        return to_route('app.artisan.creations.index')->with('success', 'Deine Kreation wurde gelöscht.');
    }

    private function ownedCreation(Request $request, Creation $creation): Creation
    {
        return $request->user()->artisan?->creations()->findOrFail($creation->id)
            ?? abort(403);
    }

    private function validateCreation(Request $request, bool $photosRequired): array
    {
        $creation = $request->route('creation');
        $existingPhotos = $creation instanceof Creation ? $creation->medias()->count() : 0;
        $remainingPhotoSlots = max(0, 6 - $existingPhotos);

        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:3000'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'price_on_request' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'photos' => [$photosRequired ? 'required' : 'nullable', 'array', 'max:' . $remainingPhotoSlots],
            'photos.*' => [File::image()->max(5120)],
        ]);
    }

    private function storePhotos(Creation $creation, Request $request): void
    {
        foreach ($request->file('photos', []) as $photo) {
            $path = $photo->storePublicly('creations', 'public');
            $creation->medias()->create(['category' => 'creation', 'path' => $path]);
        }
    }

    private function present(Creation $creation): array
    {
        return [
            'id' => $creation->id,
            'title' => $creation->title,
            'description' => $creation->description,
            'price' => $creation->price,
            'price_on_request' => $creation->price_on_request,
            'is_published' => $creation->is_published,
            'photos' => $creation->medias->map(fn ($media) => ['id' => $media->id, 'url' => Storage::url($media->path)]),
        ];
    }
}
