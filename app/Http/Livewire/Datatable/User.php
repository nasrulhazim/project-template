<?php

namespace App\Http\Livewire\Datatable;

use App\Models\User as Model;
use App\View\ActionColumn;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class User extends DataTableComponent
{
    protected $model = User::class;

    /**
     * Set any configuration options
     */
    public function configure(): void
    {
        $this->setPrimaryKey('uuid')
            ->setConfigurableAreas([
                'before-toolbar' => 'users.form',
            ]);
    }

    /**
     * The array defining the columns of the table.
     */
    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Email', 'email')
                ->sortable(),
            Column::make('Created at', 'created_at')
                ->sortable(),
            Column::make('Updated at', 'updated_at')
                ->sortable(),
            ActionColumn::make('Actions', 'uuid')
                ->form('forms.user'),
        ];
    }

    public function query(): Builder
    {
        return Model::query();
    }
}
