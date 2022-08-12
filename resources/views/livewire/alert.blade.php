<div>
    <x-jet-dialog-modal wire:model="displayingModal">
        <x-slot name="title">
            {{ $state['title'] }}
        </x-slot>

        <x-slot name="content">
            <p>
                {{ $state['message'] }}
            </p>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button class="ml-3" wire:click="$set('displayingModal', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
