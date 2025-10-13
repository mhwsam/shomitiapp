<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center px-4 py-12">
            <div class="flex flex-col items-center text-center">
                <a href="/" class="inline-flex items-center gap-3 rounded-full border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 text-base font-semibold text-white">S</span>
                    Shomiti Admin
                </a>
                <p class="mt-6 max-w-sm text-sm text-slate-600">Access your cooperative workspace to manage members and monthly collections effortlessly.</p>
            </div>

            <div class="mt-10 w-full max-w-md rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
