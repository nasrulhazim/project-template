<x-app-layout>
    <x-slot name="header">
        <div class="md:flex md:items-center space-y-4 md:space-y-0 md:justify-between">
            <div>
                <x-header title="Notifications" />
            </div>
        </div>
    </x-slot>

    <div class=" mx-auto sm:px-6 lg:px-8 pt-8">
        <livewire:datatable.notification />
    </div>
</x-app-layout>
