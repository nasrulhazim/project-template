@php
    $edit = true;
    if (isset($row)) {
        $user = $row;
        $edit = false;
    }
@endphp
<div class="flex items-center justify-between align-middle">
    <div class="flex items-center">
        <div class="mr-4">
            <x-avatar class="h-10 w-10 text-2xl" :name="$user->name" />
        </div>
        <div>
            <p class="font-semibold text-lg">
                {{ $user->name }}
            </p>
        </div>
    </div>
    <div class="flex justify-end">
        @canBeImpersonated($user)
        <a class="cursor-pointer mr-4" href="{{ url('impersonate/take') }}/{{ $user->id }}/web" x-data
            data-tippy-content="{{ __('Impersonate as') }} {{ $user->name }}">
            <x-icon name="o-user-circle" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </a>
        @endCanBeImpersonated
        @if (!$edit)
            <a class="cursor-pointer mr-4" href="{{ route('security.users.show', $user) }}" x-data
                data-tippy-content="{{ __('Manage access control for') }} {{ $user->name }}">
                <x-icon name="o-lock-open" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
                </x-icon>
            </a>
        @endif

    </div>

</div>
