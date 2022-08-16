<div class="flex justify-items-center">

    @isset($view)
        <a class="cursor-pointer mr-4" href="{{ $view }}">
            <x-icon name="o-eye" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </a>
    @endisset

    <div class="cursor-pointer mr-4" wire:click="$emitTo('{{ $form }}', 'showRecord', '{{ $row->uuid }}')">
        <x-icon name="o-pencil" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
        </x-icon>
    </div>

    <div class="cursor-pointer" 
        wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'destroyRecord', '{{ $row->uuid }}')">
        <x-icon name="o-trash"
            class="text-indigo hover:text-red-500 mr-3 flex-shrink-0 h-6 w-6">
        </x-icon>
    </div>
</div>
