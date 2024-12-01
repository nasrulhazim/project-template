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

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div x-data="{ sidebarOpen: false, activeMenu: null }" class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar for mobile -->
            <div :class="sidebarOpen ? 'block' : 'hidden'" class="fixed inset-0 z-40 md:hidden">
                <div class="fixed inset-0 bg-white bg-opacity-50" @click="sidebarOpen = false"></div>
                <div class="relative flex flex-col w-64 bg-white text-black">
                    <div class="flex items-center justify-between p-4">
                        <x-logo />
                        <button @click="sidebarOpen = false" class="text-gray-700 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <x-sidebar :menus="menu('sidebar')" />
                </div>
            </div>

            <!-- Sidebar for desktop -->
            <div class="hidden md:flex md:w-64 md:flex-col bg-white text-black">
                <x-sidebar :menus="menu('sidebar')" />
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- Navigation for mobile -->
                <header class="flex items-center justify-between p-4 bg-white shadow-md md:hidden">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 7.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                        </svg>
                    </button>
                    <x-logo />
                </header>

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class=" mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

                <!-- Toastr -->
                <x-toastr></x-toastr>
                <x-toastr-modal></x-toastr-modal>
                <x-toastr-event />
            </div>
        </div>

        @stack('modals')

        @livewireScripts
        @livewire('confirm')
        @livewire('alert')
    </body>
</html>
