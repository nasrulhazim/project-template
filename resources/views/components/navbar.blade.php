<nav x-data="{ open: false }" class="bg-slate-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xxl mx-auto px-4 md:px-6">
        <div class="flex justify-between h-14">
            <div class="w-2/6 md:hidden">&nbsp;</div>

            <div class="w-2/6 md:w-auto flex items-center justify-center text-white font-semibold">
                <a href="{{ route('dashboard') }}" class="px-4">
                    <x-icon name="home" class="w-6 h-6" />
                </a>
            </div>

            <div class="w-full flex items-center justify-end">
                @can('viewHorizon')
                    <a href="{{ url(config('horizon.path')) }}" class="ml-4" target="_blank">
                        <x-icon name="device-desktop-analytics" class="text-white text-opacity-80 w-6 h-6"></x-icon>
                    </a>
                @endcan
                <div class="relative">
                    @foreach($menus as $menu)
                        @isset($menu['child'])
                        <button type="button" class="text-slate-100 inline-flex items-center text-base font-medium hover:font-bold mt-2" aria-expanded="false">
                            <span>{{ $menu['label'] }}</span>
                        </button>
                        <div class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-md sm:px-0">
                            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                              <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                @foreach($menu['child'] as $child)
                                <a href="{{ $child['url'] }}" class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50 transition ease-in-out duration-150">
                                    <x-icon name="{{ $menu['icon'] }}" class="text-slate-700 text-opacity-80 w-6 h-6"></x-icon>
                                    <div class="ml-4">
                                      <p class="text-base font-medium text-gray-900">{{ $child['label'] }}</p>
                                      {{-- <p class="mt-1 text-sm text-gray-500">Get a better understanding of where your traffic is coming from.</p> --}}
                                    </div>
                                  </a>
                                @endforeach
                              </div>
                            </div>
                        </div>
                        @else 
                            <a href="{{ $menu['url'] }}" class="text-slate-100 inline-flex items-center text-base font-medium hover:font-bold mt-2" aria-expanded="false">
                                <x-icon name="{{ $menu['icon'] }}" class="text-white text-opacity-80 w-6 h-6"></x-icon>
                                <span class="ml-4">{{ $menu['label'] }}</span>
                            </a>
                        @endisset
                    @endforeach

                </div>

                {{-- <a href="{{ route('notifications') }}" class="ml-4"> --}}
                {{-- <x-notification-badge></x-notification-badge> --}}
                {{-- </a> --}}
                <!-- Settings Dropdown -->
                <div class="ml-1 relative">
                    <x-jet-dropdown align="right" width="w-72">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white focus:outline-none transition">
                                    <div
                                        class="h-9 w-9 rounded-full bg-primary-200 text-center py-2 text-primary-500 lowercase md:mr-4">
                                        {{ substr(auth()->user()->name, 0, 2) }}
                                    </div>
                                    <h4 class="hidden md:inline-block">{{ auth()->user()->name }}</h4>
                                    <x-icon name="chevron-down" class="ml-2 h-4 w-4"></x-icon>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="p-2">
                                <div
                                    class="mb-2 flex space-x-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition">
                                    <div
                                        class="h-9 w-9 rounded-full bg-primary-200 text-center py-2 text-primary-500 lowercase">
                                        {{ substr(auth()->user()->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4>{{ auth()->user()->name }}</h4>
                                        <p class="text-gray-500">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <x-jet-dropdown-link
                                    class="flex items-center py-2 px-3 rounded-full group hover:text-primary-500 hover:bg-primary-50"
                                    href="{{ route('profile.show') }}">
                                    <x-icon name="person" class="text-gray-500 w-5 h-5 group-hover:text-primary-500">
                                    </x-icon>
                                    <span class="font-medium ml-2">{{ __('Profile') }}</span>
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link
                                        class="flex items-center py-2 px-3 rounded-full group hover:text-primary-500 hover:bg-primary-50"
                                        href="{{ route('api-tokens.index') }}">
                                        <x-icon name="key" class="text-gray-500 w-5 h-5 group-hover:text-primary-500">
                                        </x-icon>
                                        <span class="font-medium ml-2">{{ __('API Tokens') }}</span>
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100 my-1"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link
                                        class="flex items-center py-2 px-3 rounded-full group hover:text-red-500 hover:bg-red-50"
                                        href="{{ route('logout') }}" :default="false" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        <x-icon name="sign-out" class="text-gray-500 w-5 h-5 group-hover:text-red-500">
                                        </x-icon>
                                        <span class="font-medium ml-2">{{ __('Log Out') }}</span>
                                    </x-jet-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- <x-jet-responsive-nav-link class="text-white" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link> --}}
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-1">
                        <div class="h-10 w-10 rounded-full bg-primary-200 text-center py-2 text-primary-500 lowercase">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
