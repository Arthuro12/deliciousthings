<!DOCTYPE html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        
        <title>{{  isset($title) ? config('app.name') . " | " . $title : config('app.name') }}</title>

        <link rel="icon" href="/favicon.png" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" size="180×180" href="/apple-touch-icon.png">
        
        @vite(['resources/css/website.scss', 'resources/js/third-party/alpinejs.ts'])

        @if (isset($head))
            {{ $head }} 
        @endif

        <body>
            {{ $slot }}
        </body>
    </head>
</html>