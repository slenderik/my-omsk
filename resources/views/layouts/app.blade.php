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

        {{-- For links to lib like jQuery --}}
        @stack('head-scripts')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    </head>
    <body>
        @if (session('success'))
            <dialog class="alert alert-success">
                {{ session('success') }}
            </dialog>
        @endif

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Content -->
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">    
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <main class="wrapper">
                                {{ $slot }}
                            </main>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </body>
    @stack('body-scripts')
</html>
