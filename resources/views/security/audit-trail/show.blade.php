<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Audit Details') }}
        </h2>
        <div class="my-2">{{ $sub }}</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('security.audit-trail.partials.info')
        </div>
    </div>

</x-app-layout>
