<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                @foreach (menu('administration') as $menu)
                    <div data-tippy-content="{{ data_get($menu, 'tooltip') }}"
                        class="relative flex items-center space-x-4 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm group transition-all duration-300 ease-in-out
                        hover:border-indigo-500 hover:bg-indigo-50 hover:shadow-md
                        dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 dark:hover:border-indigo-400">
                        <div class="flex-shrink-0">
                            <x-icon
                                :name="data_get($menu, 'icon', 'o-cog')"
                                class="h-6 w-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-300"
                            />
                        </div>
                        <div class="min-w-0 flex-1">
                            <a href="{{ data_get($menu, 'url') }}" class="focus:outline-none" target="{{ data_get($menu, 'target', '_self') }}">
                                <span class="absolute inset-0" aria-hidden="true"></span>
                                <p class="text-sm font-medium text-gray-900">{{ data_get($menu, 'label') }}</p>
                                <p class="truncate text-sm text-gray-500">{{ data_get($menu, 'description') }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
