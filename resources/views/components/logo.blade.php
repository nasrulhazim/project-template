<div class="flex-shrink-0 flex items-center px-4 text-base text-black">
    <a href="{{ auth()->user() ? route('dashboard') : url('/') }}" class="flex font-bold justify-center text-center w-full">
        @if (file_exists(public_path('storage/logo.png')))
            <img class="h-8 w-auto" src="{{ url('storage/logo.png') }}" alt="{{ config('app.name') }}">
        @else
            {{ config('app.name') }}
        @endif
    </a>
</div>
