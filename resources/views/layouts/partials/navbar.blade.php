<nav class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full mx-auto px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    @livewire('search')
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                @can('viewTelescope')
                    <div class="ml-3 relative">
                        <a href="{{ url(config('telescope.path')) }}" target="_blank">
                            <x-icon name="o-terminal" class="text-gray-700 hover:text-indigo-700 text-opacity-50 w-6 h-6"></x-icon>
                        </a>
                    </div>
                @endcan

                @can('viewHorizon')
                    <div class="ml-3 relative">
                        <a href="{{ url(config('horizon.path')) }}" target="_blank">
                            <x-icon name="o-desktop-computer" class="text-gray-700 hover:text-indigo-700 text-opacity-50 w-6 h-6"></x-icon>
                        </a>
                    </div>
                @endcan

                <div class="ml-3 relative">
                    <a href="{{ route('notifications') }}">
                        <x-notification-badge />
                    </a>
                </div>

                <div class="ml-3 relative">
                    <a href="{{ route('profile.show') }}" class="flex-shrink-0 w-full group block">
                        <p class="text-sm font-medium text-gray-700 hover:text-indigo-700">
                            Hi, {{ Auth::user()->name }}</p>
                    </a>
                </div>

                <div class="ml-3 relative">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        <div class="w-full cursor-pointer" onclick="event.preventDefault(); if(confirm('Are you sure want to logout?')) { this.closest('form').submit(); }"
                            class="flex-shrink-0 w-full group block">
                            @csrf
                            <div class="flex items-center">
                                <div>
                                    <x-icon name="o-logout"
                                        class="text-gray-700 flex-shrink-0 h-6 w-6 hover:text-red-500"></x-icon>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</nav>
