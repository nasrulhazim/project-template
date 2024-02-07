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
            <x-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                {{ __('NO') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="confirm" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
