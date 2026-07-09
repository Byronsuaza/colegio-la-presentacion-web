<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Colegio de La Presentación Neiva') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,600&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Cloudflare Turnstile Antispam -->
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
        <script>window.__TURNSTILE_SITE_KEY__ = "{{ config('services.turnstile.site_key') }}";</script>

        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/js/app.jsx'])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
