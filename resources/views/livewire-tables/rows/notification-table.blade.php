<x-livewire-tables::table.cell class="flex space-x-3 {{ $row->read_at ? 'text-gray-400' : '' }}">
    @empty($row->read_at)
        <div class="w-2 h-2 mt-1.5 rounded-full bg-red-500"></div>
    @else
        <div class="w-2 h-2 mt-1.5 rounded-full bg-gray-400"></div>
    @endempty
    <div>
        <div class="{{ $row->read_at ? 'text-gray-400' : 'text-gray-600' }} mb-1">{{ $row->data['subject'] }}</div>
        <div>{{ $row->data['message'] }}</div>
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="{{ $row->read_at ? 'text-gray-400' : '' }}">
    <x-carbon date="{{ $row->created_at }}"></x-carbon>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell class="{{ $row->read_at ? 'text-gray-400' : '' }}">
    <x-carbon date="{{ $row->read_at }}"></x-carbon>
</x-livewire-tables::table.cell>
