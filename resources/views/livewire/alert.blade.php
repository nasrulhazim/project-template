<div>
    <x-dialog-modal wire:model.live="displayingModal">
        <x-slot name="title">
            {{ $state['title'] }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{ $state['message'] }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-button class="ml-3" wire:click="$set('displayingModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
