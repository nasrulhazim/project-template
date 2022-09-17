<div>
    <div class="flex justify-end mb-4">
        <x-jet-button wire:click="$set('displayingModal', true)" wire:loading.attr="disabled">
            {{ __('Create New User') }}
        </x-jet-button>
    </div>
    <x-jet-dialog-modal wire:model="displayingModal">
        <x-slot name="title">
            {{ __('User Details') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full"
                    wire:model.defer="state.password" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-jet-label for="password_confirmation" value="{{ __('Password Confirmation') }}" />
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full"
                    wire:model.defer="state.password_confirmation" />
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-secondary-button wire:click="$set('displayingModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
