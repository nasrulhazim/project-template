@props([
    'tooltip' => 'Status',
    'condition' => false,
    'okIcon' => 'o-check',
    'okClass' => 'text-green-500 border-green-500',
    'falseIcon' => 'o-x',
    'falseClass' => 'text-red-500 border-red-500',
    'okLabel' => 'Active',
    'falseLabel' => 'Inactive',
    'labelClass' => 'ml-2 text-sm',
])
<div class="flex align-middle">
    <x-icon name="{{ $condition ? $okIcon : $falseIcon }}"
    class="rounded-full border-2 w-5 h-5 flex-shrink-0 {{ $condition ? $okClass : $falseClass }}"></x-icon>
    <span class="{{ $labelClass }}">{{ $condition ? $okLabel : $falseLabel }}</span>
</div>
