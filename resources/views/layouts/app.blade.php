<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'My-Omsk') }}</title>

        {{-- Favicon --}}
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/x-icon">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- CSS --}}
        <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    </head>
    <body>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main class="wrapper">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
