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
    </head>
    <body class="font-sans antialiased bg-slate-100">
        <div class="fixed top-0 inset-x-0 z-20">
            <x-impersonating></x-impersonating>
        </div>

        <div>
            @livewire('menu', ['menu' => 'sidebar'])
            <div class="md:pl-64">
                @livewire('menu', ['menu' => 'navbar'])
                <div>
                    @if(breadcrumb_enabled())
                        <div>
                            {{ Breadcrumbs::render() }}
                        </div>
                    @endif
                    @isset($header)
                        <div class="px-4 py-10">
                            {{ $header }}
                        </div>
                    @endisset
                </div>
                <div>
                    {{ $slot }}
                </div>
            </div>
        </div>
        
        @stack('modals')

        <!-- Scripts -->
        @vite('resources/js/app.js')

        @livewireScripts

        @livewire('confirm')
        @livewire('alert')
        @stack('scripts')
    </body>
</html>
