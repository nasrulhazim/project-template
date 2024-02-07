@props([
    'name' => 'file',
    'label' => 'File',
    'accept' => false,
    'multiple' => false,
    'required' => false,
])

<div>
    <input wire:model.live="{{ $name }}"
        class="bg-gray-50 block border border-gray-300 cursor-pointer dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 focus:outline-none text-gray-900 w-full rounded"
        type="file"
        @if($accept) accept="{{ $accept }}" @endif
        @if($multiple) multiple @endif
        @if($required) required @endif
    >
    <x-input-error for="{{ $name }}" class="mt-2" />
</div>
