@php
$hasNotification = auth()
    ->user()
    ->hasNotifications();
@endphp

<div class="relative">
    @if ($hasNotification)
        <div class="w-3 h-3 rounded-full absolute ml-4 -mt-2 bg-red-500"></div>
    @endif
    <x-icon name="o-bell" class="text-slate-500 text-opacity-50 w-6 h-6"></x-icon>
</div>
