<div>
    @if ($displayCreateRecord)
        <div class="flex justify-end mb-4">
            <x-button wire:click="create" wire:loading.attr="disabled">
                {{ __('Add New Access Control') }}
            </x-button>
        </div>
    @elseif($edit)
        <div class="cursor-pointer mr-4" wire:click="$dispatch('showRecord', ['{{ $uuid }}', true])">
            <x-icon name="o-pencil" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
    @endif
    <x-dialog-modal wire:model.live="displayingModal" class="h-full">
        <x-slot name="title">
            {{ __('Role Details') }}
        </x-slot>

        <x-slot name="content">

            @includeWhen($edit, 'livewire.forms.access-control-edit')
            @includeWhen(!$edit, 'livewire.forms.access-control-show')

        </x-slot>

        <x-slot name="footer">
            @include('livewire.forms.partials.footer')
        </x-slot>
    </x-dialog-modal>
</div>
