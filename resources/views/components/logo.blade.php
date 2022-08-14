<div class="flex-shrink-0 flex items-center px-4">
    <a href="{{ auth()->user() ? route('dashboard') : url('/') }}" class="text-center w-full font-bold">
        @if (file_exists(public_path('storage/logo.png')))
            <img class="h-8 w-auto" src="{{ url('storage/logo.png') }}" alt="{{ config('app.name') }}">
        @else
            {{ config('app.name') }}
        @endif
    </a>
</div>
