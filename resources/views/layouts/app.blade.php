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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        @stack('styles')

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="fixed top-0 inset-x-0 z-20">
            <x-impersonating></x-impersonating>
            <x-navbar></x-navbar>
        </div>

        <div class="flex @impersonating pt-28 md:pt-24 @else pt-14 @endImpersonating">
            <div class="w-full md:min-h-screen md:max-w-xxl mx-auto p-4 md:px-6 lg:px-8 md:py-6 relative">
                <div class="mt-6">
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
