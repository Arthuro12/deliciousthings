<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {     
        $authenticatedUser = $request->user();
        $userAccount = null;
        if ($authenticatedUser) {
            $authenticatedUser = $authenticatedUser->fresh(['artisan']);
            $userAccount = $authenticatedUser->only(['id', 'first_name', 'last_name']);
            $userAccount['artisan_profile'] = $authenticatedUser->artisan?->only(['id', 'name']);
        }  

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $userAccount,
            ],
            'flash' => function () use ($request) {
                return [
                    'info' => $request->session()->get('info'),
                    'success' => $request->session()->get('success'),
                ];
            }
        ];
    }
}