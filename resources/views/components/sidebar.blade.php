<div class="flex flex-col h-full overflow-y-auto">
    <div class="flex-shrink-0 flex items-center justify-center h-16 bg-white">
        <x-logo />
    </div>
    <nav class="flex-1 px-2 py-4 space-y-1">
        @foreach ($menus as $menu)
            <div x-data="{ isOpen: false }" class="space-y-1">
                @if (data_get($menu, 'type') === 'form')
                    <!-- Form-based menu item (e.g., Logout) -->
                    <form method="{{ data_get($menu, 'formAttributes.method', 'POST') }}" action="{{ data_get($menu, 'url') }}" class="flex items-center">
                        @if (data_get($menu, 'formAttributes.csrf'))
                            @csrf
                        @endif
                        <button type="submit" class="flex w-full items-center px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md"
                        data-tippy-content="{{ data_get($menu, 'tooltip') }}">
                            <x-icon name="{{ data_get($menu, 'icon', 'o-cog') }}" class="h-5 w-5 mr-3" />
                            {{ data_get($menu, 'label') }}
                        </button>
                    </form>
                @else
                    <!-- Link-based menu item -->
                    <a href="{{ data_get($menu, 'url', '#') }}" data-tippy-content="{{ data_get($menu, 'tooltip') }}"
                       @if (data_get($menu, 'children')) @click="isOpen = !isOpen" @endif
                       class="flex items-center px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-md">
                        <x-icon name="{{ data_get($menu, 'icon', 'o-cog') }}" class="h-5 w-5 mr-3" />
                        {{ data_get($menu, 'label') }}
                        @if (data_get($menu, 'children'))
                            <svg class="ml-auto h-5 w-5 transition-transform"
                                 :class="isOpen ? 'rotate-90' : ''" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        @endif
                    </a>
                @endif

                @if (data_get($menu, 'children'))
                    <!-- Nested children menu -->
                    <div x-show="isOpen" x-cloak class="ml-6 space-y-1">
                        @foreach (data_get($menu, 'children', []) as $child)
                            <a href="{{ data_get($child, 'url', '#') }}"
                               class="flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-md">
                                <x-icon name="{{ data_get($child, 'icon', 'o-cog') }}" class="h-5 w-5 mr-3" />
                                {{ data_get($child, 'label') }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </nav>
</div>
