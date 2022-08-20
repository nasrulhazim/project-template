<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center space-y-4 md:space-y-0 md:justify-between">
            <div>
                <x-header title="Notifications" />
            </div>
        </div>
    </x-slot>

    <x-panel>
        <livewire:notification-datatable />
    </x-panel>
</x-app-layout>
