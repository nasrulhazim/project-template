<div x-data="{ open: false }">

    <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
    <div class="relative z-40 md:hidden" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" x-show="open"></div>

        <div class="fixed inset-0 flex z-40" x-show="open">
            <div class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Close sidebar</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <x-logo />
                    <nav class="mt-5 px-2 space-y-1">
                        @foreach ($menus as $menu)
                            @php
                                $label = __($menu['label']);
                                $url = route($menu['route']);
                                $icon = $menu['icon'];
                                $icon_class = request()->routeIs($menu['route']) ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500';
                                $class = request()->routeIs($menu['route']) ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
                            @endphp
                            <a href="{{ $url }}"
                                class="{{ $class }} group flex items-center px-2 py-2 text-base font-medium rounded-md">
                                <x-icon name="{{ $icon }}"
                                    class="{{ $icon_class }} mr-4 flex-shrink-0 h-6 w-6"></x-icon>
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>
                </div>
                <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                    <a href="{{ route('profile.show') }}" class="flex-shrink-0 group block">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block h-10 w-10 rounded-full"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="ml-3">
                                <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">
                                    {{ Auth::user()->name }}</p>
                                <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">
                                    {{ __('View profile') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        <div class="w-full cursor-pointer" onclick="event.preventDefault(); if(confirm('Are you sure want to logout?')) { this.closest('form').submit(); }"
                            class="flex-shrink-0 w-full group block">
                            @csrf
                            <div class="flex items-center">
                                <div>
                                    <x-icon name="o-logout"
                                        class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"></x-icon>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                    {{ __('Log Out') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="flex-shrink-0 w-14">
                <!-- Force sidebar to shrink to fit close icon -->
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white">
            <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                <x-logo />
                <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
                    @foreach ($menus as $menu)
                        @php
                            $label = __($menu['label']);
                            $url = route($menu['route']);
                            $icon = $menu['icon'];
                            $icon_class = request()->routeIs($menu['route']) ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500';
                            $class = request()->routeIs($menu['route']) ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900';
                        @endphp

                        <a href="{{ $url }}"
                            class="{{ $class }} group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                            <x-icon name="{{ $icon }}" class="{{ $icon_class }} mr-3 flex-shrink-0 h-6 w-6">
                            </x-icon>
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </div>
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <a href="{{ route('profile.show') }}" class="flex-shrink-0 w-full group block">
                    <div class="flex items-center">
                        <div>
                            <img class="inline-block h-9 w-9 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                {{ Auth::user()->name }}</p>
                            <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">
                                {{ __('View profile') }}
                            </p>
                        </div>
                    </div>

                </a>
            </div>
            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    <div class="w-full cursor-pointer" onclick="event.preventDefault(); if(confirm('Are you sure want to logout?')) { this.closest('form').submit(); }"
                        class="flex-shrink-0 w-full group block">
                        @csrf
                        <div class="flex items-center">
                            <div>
                                <x-icon name="o-logout"
                                    class="text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6"></x-icon>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                                {{ __('Log Out') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
