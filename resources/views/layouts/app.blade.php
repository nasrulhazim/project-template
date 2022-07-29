<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @vite('resources/css/app.css')

        @livewireStyles

        @stack('styles')

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="font-sans antialiased bg-slate-100">
        <div class="fixed top-0 inset-x-0 z-20">
            <x-impersonating></x-impersonating>
            @livewire('navigation-menu')
        </div>

        <div class="flex @impersonating pt-28 md:pt-24 @else pt-14 @endImpersonating">
            <div class="w-full md:max-w-7xl mx-auto md:py-6 relative">
                <div>
                    {{ Breadcrumbs::render() }}
                </div>
                {{ $slot }}
            </div>
        </div>
        
        @stack('modals')

        @livewireScripts

        @stack('scripts')
    </body>
</html>
