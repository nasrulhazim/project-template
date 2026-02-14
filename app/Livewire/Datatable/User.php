<?php

namespace App\Livewire\Datatable;

use App\Concerns\InteractsWithDatatable;
use App\Models\User as Model;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class User extends Component
{
    use InteractsWithDatatable;

    public function query(): Builder
    {
        return Model::query()->with(['roles']);
    }

    public function columns(): array
    {
        return [
            [
                'key' => 'name',
                'label' => __('Name'),
                'sortable' => true,
                'searchable' => true,
                'view' => 'security.users.partials.info',
            ],
            [
                'key' => 'email',
                'label' => 'Email',
                'visible' => false,
                'searchable' => true,
            ],
        ];
    }

    public function filters(): array
    {
        return [
            [
                'key' => 'role',
                'label' => __('Role'),
                'type' => 'select',
                'options' => to_options(role_options()),
                'query' => fn (Builder $query, $value) => $query->role($value),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.datatable.user');
    }
}
