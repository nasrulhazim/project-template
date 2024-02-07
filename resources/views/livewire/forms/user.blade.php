<div>
    <div class="flex justify-end mb-4">
        <x-button wire:click="$set('displayingModal', true)" wire:loading.attr="disabled">
            {{ __('Create New User') }}
        </x-button>
    </div>
    <x-dialog-modal wire:model.live="displayingModal">
        <x-slot name="title">
            {{ __('User Details') }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" />
                <x-input-error for="name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" />
                <x-input-error for="email" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" class="mt-1 block w-full"
                    wire:model="state.password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4 mt-2">
                <x-label for="password_confirmation" value="{{ __('Password Confirmation') }}" />
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full"
                    wire:model="state.password_confirmation" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-secondary-button wire:click="$set('displayingModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
