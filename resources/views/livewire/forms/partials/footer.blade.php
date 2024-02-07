<x-action-message class="mr-3" on="saved">
    {{ __('Saved.') }}
</x-action-message>

<x-secondary-button wire:click="close" wire:loading.attr="disabled">
    @if ($edit)
        {{ __('Cancel') }}
    @else
        {{ __('Close') }}
    @endif
</x-secondary-button>

@if ($edit)
    <x-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
        {{ __('Save') }}
    </x-button>
@endif
