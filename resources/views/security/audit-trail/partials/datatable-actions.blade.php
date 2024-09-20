<div class="flex justify-items-center">
    @can('view', $row)
        <a class="cursor-pointer mr-4" href="{{ route('security.audit-trail.show', $row->uuid) }}"  x-data x-tooltip="View Record Details">
            <x-icon name="o-eye" class="text-indigo hover:font-bold mr-3 flex-shrink-0 h-6 w-6">
            </x-icon>
        </a>
    @endcan
</div>
