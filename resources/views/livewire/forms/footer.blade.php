<x-jet-action-message class="mr-3" on="saved">
    {{ __('Saved.') }}
</x-jet-action-message>

<x-jet-secondary-button wire:click="close" wire:loading.attr="disabled">
    @if ($edit)
        {{ __('Cancel') }}
    @else
        {{ __('Close') }}
    @endif
</x-jet-secondary-button>

@if ($edit)
    <x-jet-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-jet-button>
@endif
