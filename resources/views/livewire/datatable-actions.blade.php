<div class="flex justify-items-center">
    @can('view', $row)
        <a class="cursor-pointer mr-4" href="{{ $row->getResourceUrl('show') }}">
            <x-icon name="o-eye" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </a>
    @endcan
    
    @can('update', $row)
        <a class="cursor-pointer mr-4" 
            @if($form) 
                wire:click="$emitTo('{{ $form }}', 'showRecord', '{{ $row->uuid }}')" 
            @else 
                href="{{ $row->getResourceUrl('edit') }}"
            @endif>
            <x-icon name="o-pencil" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </a>
    @endcan

    @can('delete', $row)
        <div class="cursor-pointer"
            wire:click="$emitTo('confirm', 'displayConfirmation', 'Delete Record', 'Are you sure?', '{{ $form }}', 'destroyRecord', '{{ $row->uuid }}')">
            <x-icon name="o-trash" class="text-indigo hover:text-red-500 mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </div>
    @endcan
</div>
