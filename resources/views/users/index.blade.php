<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <x-panel>
        <livewire:user-datatable />
    </x-panel>
</x-app-layout>
