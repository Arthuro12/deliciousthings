<!DOCTYPE html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        
        <title>{{  isset($title) ? config('app.name') . " | " . $title : config('app.name') }}</title>

        <link rel="icon" href="/favicon.png" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" size="180×180" href="/apple-touch-icon.png">
        
        @vite([
            'resources/css/tailwind.css', 
            'resources/css/website.scss', 
            'resources/js/third-party/alpinejs.ts'
        ])

        @if (isset($head))
            {{ $head }} 
        @endif
    </head>

    <body class="auth-layout">
        <div class="auth-layout__root">
            <div @style([
                'display: flex',
                'flex-direction: column',
                'flex: 1',
                'min-height: 100%',
            ])>
                <div 
                    @style([
                        'display: flex',
                        'flex-direction: column',
                        'justify-content: center',
                    ])>
                    <div class="auth-layout__wrapper">
                        <div class="auth-layout__top-spacer"></div>
                        <x-layout.auth.header class="auth-layout__header" />

                        <div class="auth-layout__content-wrapper">
                            {{ $slot }}
                        </div> 
                    </div> 
                </div>
                <div 
                    @style([
                        'display: flex',
                        'flex-direction: column',
                        'justify-content: center',
                        'align-items: center',
                        'padding-block: 20px',
                    ])
                ></div>
            </div>
        </div>
    </body>
</html>