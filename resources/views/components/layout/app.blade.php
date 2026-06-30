<!DOCTYPE html>
<html>
    <head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        
        <title>{{  isset($title) ? config('app.name') . " | " . $title : config('app.name') }}</title>

        <link rel="icon" href="/favicon.png" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        @vite(['resources/css/app.scss'])

        @if (isset($head))
            {{ $head }} 
        @endif
    </head>

    <body>
        <x-header />

        {{ $slot }}

        <x-footer />
    </body>
</html>