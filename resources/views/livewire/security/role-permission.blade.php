<div>
    <input type="checkbox" class="cursor-pointer" wire:click="update"
    {{ $checked ? 'checked' : ''}}
    name="{{ $permission_name }}">
    <x-action-message on="saved">
        {{ __('Saved.') }}
    </x-action-message>
</div>
