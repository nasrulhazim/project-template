<div>
    {{-- Toolbar --}}
    <div class="flex items-center justify-between mb-4 gap-4">
        @if ($this->showSearch)
            <div class="flex-1 max-w-sm">
                <x-input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ __('Search...') }}"
                    class="w-full"
                />
            </div>
        @endif

        <div class="flex items-center gap-2">
            @if (count($this->filters()) > 0)
                <x-secondary-button type="button" wire:click="$toggle('showFilters')">
                    {{ __('Filters') }}
                    @if (count(array_filter($filterValues)))
                        <span class="ml-1 text-xs bg-indigo-100 text-indigo-800 rounded-full px-2 py-0.5">
                            {{ count(array_filter($filterValues)) }}
                        </span>
                    @endif
                </x-secondary-button>
            @endif
        </div>
    </div>

    {{-- Filter Panel --}}
    @if (count($this->filters()) > 0)
        <div
            x-data="{ open: @entangle('showFilters') }"
            x-show="open"
            x-collapse
            class="mb-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg"
        >
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($this->filters() as $filter)
                    <div>
                        <x-label :value="$filter['label']" class="mb-1" />
                        @if (($filter['type'] ?? 'select') === 'select')
                            <x-select
                                wire:model.live="filterValues.{{ $filter['key'] }}"
                                class="w-full"
                            >
                                <option value="">{{ __('All') }}</option>
                                @foreach ($filter['options'] as $optionValue => $optionLabel)
                                    <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
                                @endforeach
                            </x-select>
                        @elseif ($filter['type'] === 'date')
                            <x-input
                                type="date"
                                wire:model.live="filterValues.{{ $filter['key'] }}"
                                class="w-full"
                            />
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="mt-3 flex justify-end">
                <x-secondary-button type="button" wire:click="clearFilters" class="text-sm">
                    {{ __('Clear Filters') }}
                </x-secondary-button>
            </div>
        </div>
    @endif

    {{-- Bulk Actions --}}
    @if (count($this->bulkActions()) > 0 && count($selected) > 0)
        <div class="mb-4 p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg flex items-center gap-4">
            <span class="text-sm text-indigo-700 dark:text-indigo-300">
                {{ count($selected) }} {{ __('selected') }}
            </span>
            @foreach ($this->bulkActions() as $action => $label)
                <x-secondary-button type="button" wire:click="applyBulkAction('{{ $action }}')" class="text-sm">
                    {{ __($label) }}
                </x-secondary-button>
            @endforeach
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    @if (count($this->bulkActions()) > 0)
                        <th class="w-8 px-4 py-3">
                            <x-checkbox wire:model.live="selectAll" />
                        </th>
                    @endif
                    @foreach ($this->columns() as $column)
                        @if ($column['visible'] ?? true)
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                @if ($column['sortable'] ?? false)
                                    <button
                                        type="button"
                                        wire:click="sortBy('{{ $column['key'] }}')"
                                        class="flex items-center gap-1 hover:text-gray-700 dark:hover:text-gray-200"
                                    >
                                        {{ $column['label'] }}
                                        @if ($sortField === $column['key'])
                                            <span class="text-indigo-500">
                                                @if ($sortDirection === 'asc')
                                                    &#9650;
                                                @else
                                                    &#9660;
                                                @endif
                                            </span>
                                        @endif
                                    </button>
                                @else
                                    {{ $column['label'] }}
                                @endif
                            </th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($this->rows as $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800" wire:key="row-{{ $row->getKey() }}">
                        @if (count($this->bulkActions()) > 0)
                            <td class="w-8 px-4 py-3">
                                <x-checkbox wire:model.live="selected" value="{{ $row->getKey() }}" />
                            </td>
                        @endif
                        @foreach ($this->columns() as $column)
                            @if ($column['visible'] ?? true)
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-100">
                                    @if (isset($column['view']))
                                        @include($column['view'], ['row' => $row])
                                    @elseif (isset($column['format']))
                                        {{ $column['format'](data_get($row, $column['key'])) }}
                                    @else
                                        {{ data_get($row, $column['key']) }}
                                    @endif
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td
                            colspan="{{ count(array_filter($this->columns(), fn ($c) => $c['visible'] ?? true)) + (count($this->bulkActions()) > 0 ? 1 : 0) }}"
                            class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400"
                        >
                            {{ __('No records found.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $this->rows->links() }}
    </div>
</div>
