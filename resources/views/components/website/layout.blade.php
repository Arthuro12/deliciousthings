<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover"
    >

    <title>
        {{ isset($title) ? config('app.name') . ' | ' . $title : config('app.name') }}
    </title>

    @if (isset($description))
        <meta
            name="description"
            content="{{ $description }}"
        >
    @endif

    <link rel="icon" href="/favicon.png" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" sizes="180x180">

    @vite([
        'resources/css/website.scss',
    ])

    @if (isset($head))
        {{ $head }}
    @endif
</head>

<body class="website">

    <x-website.header />

    <main>
        {{ $slot }}
    </main>

    <x-website.footer />

</body>
</html>