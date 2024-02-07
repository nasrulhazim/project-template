<div class="flex justify-items-center">
    @can('view', $row)
        <div class="cursor-pointer mr-4"  wire:click="$dispatch('{{ $form }}', 'showRecord', '{{ $row->uuid }}')">
            <x-icon name="o-eye" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
    @endcan

    @can('update', $row)
        <div class="cursor-pointer mr-4" wire:click="$dispatch('{{ $form }}', 'showRecord', '{{ $row->uuid }}', true)">
            <x-icon name="o-pencil" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
        <div class="cursor-pointer mr-4" wire:click="$dispatch('{{ $form }}', 'showAccessControl', '{{ $row->uuid }}', true)">
            <x-icon name="o-key" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
    @endcan

    @can('delete', $row)
        <div class="cursor-pointer"
            wire:click="$dispatch('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'destroyRecord', '{{ $row->uuid }}')">
            <x-icon name="o-trash" class="text-indigo hover:text-red-500 mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
    @endcan
</div>
