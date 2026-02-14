<?php

namespace App\Concerns;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait InteractsWithDatatable
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public string $sortField = '';

    public string $sortDirection = 'asc';

    public int $perPage = 15;

    public array $filterValues = [];

    public array $selected = [];

    public bool $selectAll = false;

    public bool $showSearch = true;

    public bool $showFilters = false;

    abstract public function query(): Builder;

    abstract public function columns(): array;

    public function filters(): array
    {
        return [];
    }

    public function bulkActions(): array
    {
        return [];
    }

    public function defaultSort(): array
    {
        return [];
    }

    public function mountInteractsWithDatatable(): void
    {
        $defaultSort = $this->defaultSort();
        if (! empty($defaultSort)) {
            $this->sortField = array_key_first($defaultSort);
            $this->sortDirection = $defaultSort[$this->sortField];
        }
    }

    #[On('refreshDatatable')]
    public function refreshDatatable(): void
    {
        unset($this->rows);
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterValues(): void
    {
        $this->resetPage();
    }

    public function updatedSelectAll(bool $value): void
    {
        $this->selected = $value
            ? $this->rows->pluck('id')->map(fn ($id) => (string) $id)->toArray()
            : [];
    }

    public function applyBulkAction(string $action): void
    {
        if (method_exists($this, $action) && array_key_exists($action, $this->bulkActions())) {
            $this->$action();
            $this->selected = [];
            $this->selectAll = false;
            unset($this->rows);
        }
    }

    public function clearFilters(): void
    {
        $this->filterValues = [];
        $this->resetPage();
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        $query = $this->query();

        $this->applySearch($query);
        $this->applyFilters($query);
        $this->applySort($query);

        return $query->paginate($this->perPage);
    }

    protected function applySearch(Builder $query): void
    {
        if (empty($this->search)) {
            return;
        }

        $searchableColumns = collect($this->columns())
            ->filter(fn ($col) => $col['searchable'] ?? false)
            ->pluck('key')
            ->toArray();

        if (empty($searchableColumns)) {
            return;
        }

        $query->where(function (Builder $q) use ($searchableColumns) {
            foreach ($searchableColumns as $column) {
                if (str_contains($column, '.')) {
                    [$relation, $field] = explode('.', $column, 2);
                    $q->orWhereHas($relation, fn (Builder $sub) => $sub->where($field, 'like', "%{$this->search}%"));
                } else {
                    $q->orWhere($column, 'like', "%{$this->search}%");
                }
            }
        });
    }

    protected function applyFilters(Builder $query): void
    {
        foreach ($this->filters() as $filter) {
            $key = $filter['key'];
            $value = $this->filterValues[$key] ?? null;

            if ($value === null || $value === '') {
                continue;
            }

            if (isset($filter['query'])) {
                $filter['query']($query, $value);
            }
        }
    }

    protected function applySort(Builder $query): void
    {
        if (! empty($this->sortField)) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }
    }
}
