<div>
    <button type="button" wire:click="update('{{ $key }}', '{{ $value }}', '{{ $field }}')"
        class="{{ $enabled ? 'bg-indigo-600' : 'bg-gray-200' }} relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
        role="switch" aria-checked="false">
        <span class="sr-only">{{ $label ?? 'Status' }}</span>
        <span aria-hidden="true"
            class="{{ $enabled ? 'translate-x-5' : 'translate-x-0' }} pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
        </span>
    </button>

    <x-action-message on="saved">
        {{ __('Saved.') }}
    </x-action-message>
</div>
