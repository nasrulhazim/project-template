<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Trail') }}
        </h2>
        <div class="my-2">{{ $sub }}</div>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            @livewire('datatable.audit-trail')
        </div>
    </div>
</x-app-layout>
