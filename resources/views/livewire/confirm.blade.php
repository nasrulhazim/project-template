<div>
    <x-jet-dialog-modal wire:model.live="displayingModal">
        <x-slot name="title">
            {{ $state['title'] }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{ $state['message'] }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="cancel" wire:loading.attr="disabled">
                {{ __('NO') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="confirm" wire:loading.attr="disabled">
                {{ __('Yes') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
