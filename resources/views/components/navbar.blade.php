<nav x-data="{ open: false }" class="bg-slate-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-screen-xxl mx-auto px-4 md:px-6">
        <div class="flex justify-between h-14">

            <div class="md:w-auto flex items-center justify-center text-white font-semibold">
                <a href="{{ route('dashboard') }}" class="px-4">
                    <x-icon name="o-home" class="w-6 h-6" />
                </a>
            </div>

            <div class="w-full flex items-center justify-end text-white">
                @can('viewHorizon')
                    <a href="{{ url(config('horizon.path')) }}" class="ml-4" target="_blank">
                        <x-icon name="o-desktop-computer" class="w-6 h-6" />
                    </a>
                @endcan

                @can('viewAny', \App\Models\User::class)
                    <a href="{{ route('users.index') }}" class="ml-4">
                        <x-icon name="o-users" class="w-6 h-6" />
                    </a>
                @endcan
                

                <a href="{{ route('notifications') }}" class="ml-4">
                    <x-notification-badge></x-notification-badge>
                </a>
                <!-- Settings Dropdown -->
                <div class="ml-1 relative">
                    <x-jet-dropdown align="right" width="w-72">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white focus:outline-none transition">
                                    <div
                                        class="h-9 w-9 rounded-full bg-slate-100 text-center py-2 text-slate-700 lowercase md:mr-4">
                                        {{ substr(auth()->user()->name, 0, 2) }}
                                    </div>
                                    <h4 class="hidden md:inline-block">{{ auth()->user()->name }}</h4>
                                    <x-icon name="o-chevron-down" class="ml-2 h-4 w-4"></x-icon>
                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="p-2">
                                <div
                                    class="mb-2 flex space-x-4 items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition">
                                    <div
                                        class=" bg-slate-700 border h-9 lowercase md:mr-4 py-2 rounded-full text-center text-slate-100 w-9">
                                        {{ substr(auth()->user()->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h4 class="text-slate-700">{{ auth()->user()->name }}</h4>
                                        <p class="text-slate-500">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <x-jet-dropdown-link
                                    class="flex items-center py-2 px-3 rounded-full group hover:text-primary-500 hover:bg-primary-50"
                                    href="{{ route('profile.show') }}">
                                    <x-icon name="o-user" class="text-gray-500 w-5 h-5 group-hover:text-primary-500">
                                    </x-icon>
                                    <span class="font-medium ml-2">{{ __('Profile') }}</span>
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link
                                        class="flex items-center py-2 px-3 rounded-full group hover:text-primary-500 hover:bg-primary-50"
                                        href="{{ route('api-tokens.index') }}">
                                        <x-icon name="o-key" class="text-gray-500 w-5 h-5 group-hover:text-primary-500">
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
                                        <x-icon name="o-logout" class="text-gray-500 w-5 h-5 group-hover:text-red-500">
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
            <x-jet-responsive-nav-link class="text-white" href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link> 
            @can('viewHorizon')
                <x-jet-responsive-nav-link class="text-white" href="{{ url(config('horizon.path')) }}">
                    {{ __('Horizon') }}
                </x-jet-responsive-nav-link> 
            @endcan
            @can('viewAny', \App\Models\User::class)
                <x-jet-responsive-nav-link class="text-white" href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                    {{ __('Users') }}
                </x-jet-responsive-nav-link> 
            @endcan
            <x-jet-responsive-nav-link class="text-white" href="{{ route('notifications') }}" :active="request()->routeIs('notifications')">
                {{ __('Notifications') }}
            </x-jet-responsive-nav-link> 
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
