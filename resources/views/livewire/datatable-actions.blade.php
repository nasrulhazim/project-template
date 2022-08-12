<div class="flex justify-items-center">
    <div class="cursor-pointer mr-4" wire:click="$emitTo('connection-form', 'showConnection', '{{ $row->uuid }}')">
        {{ __('Edit') }}
    </div>

    <div class="cursor-pointer" class="bg-red-500" 
        wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Connection', 'Are you sure?', 'connection-form', 'destroyConnection', '{{ $row->uuid }}')">
        {{ __('Remove') }}
    </div>
</div>
