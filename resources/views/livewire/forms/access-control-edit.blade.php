<input type="hidden" wire:model="state.guard_name"/>

<div class="col-span-6 sm:col-span-4 mt-2">
    <x-label for="display_name" value="{{ __('Name') }}" required="true"/>
    <x-input id="display_name" type="text" class="mt-1 block w-full"
        wire:model="state.display_name" />
    <x-input-error for="display_name" class="mt-2" />
</div>

<div class="col-span-6 sm:col-span-4 mt-2">
    <x-label for="description" value="{{ __('Description') }}" required="true"/>
    <textarea wire:model="state.description" id="description" rows="5"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"></textarea>
    <x-input-error for="description" class="mt-2" />
</div>
