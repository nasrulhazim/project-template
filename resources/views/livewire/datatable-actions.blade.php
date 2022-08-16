<div class="flex justify-items-center">

    @isset($view)
        <a class="cursor-pointer mr-4" href="{{ $view }}">
            {{ __('View') }}
        </a>
    @endisset

    <div class="cursor-pointer mr-4" wire:click="$emitTo('{{ $form }}', 'showRecord', '{{ $row->uuid }}')">
        {{ __('Edit') }}
    </div>

    <div class="cursor-pointer" class="bg-red-500"
        wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'destroyRecord', '{{ $row->uuid }}')">
        {{ __('Remove') }}
    </div>
</div>
