<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
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
    protected $rootView = 'platform';

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
        $user = $request->user();

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => [
                    $user->only(['id', 'first_name', 'last_name', 'email']),
                ],
            ],
            'links' => [
                'guest' => [ 
                    [
                        'title' => 'Website',
                        'href' => route('home'),
                    ],
                ],
                'user' => [
                    [
                        'title' => 'Startseite',
                        'href' => route('app.home'),
                        'iconName' => 'house',
                    ], 
                    [
                        'title' => 'Projekte',
                        'href' => route('app.user.projects'),
                        'iconName' => 'folder',
                    ],      
                    [
                        'title' => 'Chats',
                        'href' => route('app.user.messages'),
                        'iconName' => 'message-square',
                    ], 
                    [
                        'title' => 'Anfragen',
                        'href' => route('app.user.requests'),
                        'iconName' => 'mail',
                    ], 
                    [
                        'title' => 'Profil',
                        'href' => route('app.user.profile'),
                        'iconName' => 'circle-user-round',
                    ], 
                ]
            ],
            // 'flash' => function () use ($request) {
            //     return [
            //         'info' => $request->session()->get('info'),
            //         'success' => $request->session()->get('success'),
            //         'error' => $request->session()->get('error'),
            //     ];
            // }
        ];
    }
}