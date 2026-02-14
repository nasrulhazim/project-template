<?php

namespace App\Livewire\Datatable;

use App\Concerns\InteractsWithDatatable;
use App\Models\Role as Model;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class AccessControl extends Component
{
    use InteractsWithDatatable;

    public function mountAccessControl(): void
    {
        $this->perPage = 100;
        $this->showSearch = false;
    }

    public function query(): Builder
    {
        return Model::query()
            ->where('name', '!=', 'superadmin')
            ->orderBy('is_enabled', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            [
                'key' => 'display_name',
                'label' => __('Role'),
                'sortable' => true,
                'searchable' => true,
                'view' => 'security.access-control.partials.info',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.datatable.access-control');
    }
}
