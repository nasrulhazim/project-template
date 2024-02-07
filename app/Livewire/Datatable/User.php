<?php

namespace App\Livewire\Datatable;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class User extends DataTableComponent
{
    protected $model = Model::class;

    /**
     * Set any configuration options
     */
    public function configure(): void
    {
        $this->setPrimaryKey('uuid')
            ->setAdditionalSelects([
                'users.id',
                'users.uuid',
            ])
            ->setEagerLoadAllRelationsEnabled()
            ->setConfigurableAreas([
                'before-toolbar' => 'administration.users.form',
            ]);
    }

    /**
     * The array defining the columns of the table.
     */
    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->view('administration.users.partials.info')
                ->sortable(),
            Column::make('Email', 'email')->hideIf(true)->searchable(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Role')
                ->options(to_options(role_options()))
                ->filter(fn ($query, $value) => $query->role($value)),
        ];
    }

    public function builder(): Builder
    {
        return Model::query();
    }
}
