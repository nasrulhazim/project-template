<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Access Control Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl">
            @include('administration.access-control.partials.info', ['edit' => true])
            <hr class="my-4">
            @include('administration.access-control.partials.permissions')
        </div>
    </div>
</x-app-layout>
