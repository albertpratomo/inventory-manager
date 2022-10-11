<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Inventory Manager') }}</title>

        <!-- Scripts -->
        @vite('resources/vue/app.ts')
        @inertiaHead
    </head>

    <body class="antialiased">
        @inertia
    </body>
</html>
