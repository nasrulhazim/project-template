@impersonating
    <div class="bg-red-600 py-2 text-slate-100 text-center">
        <div>
            <x-icon name="o-exclamation-circle" class="mb-1 w-5 h-5 text-primary-500 hidden md:inline-block mr-1"></x-icon>
            <span>{{ __('You\'re currently impersonating') }}</span>
            <span class="font-medium">{{ auth()->user()->name }}</span>
            <a class="text-primary-500 font-semibold block md:inline-block hover:text-slate-600" href="{{ route('impersonate.leave') }}">Leave Impersonation</a>
        </div>
    </div>
@endImpersonating
