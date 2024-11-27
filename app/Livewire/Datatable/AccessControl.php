<?php

namespace App\Livewire\Datatable;

use App\Models\Role as Model;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class AccessControl extends DataTableComponent
{
    public ?int $perPage = 100;

    public array $perPageAccepted = [100];

    public bool $paginationStatus = true;

    protected bool $columnSelectStatus = false;

    public bool $searchStatus = false;

    public function configure(): void
    {
        $this->setPrimaryKey('uuid')
            ->setAdditionalSelects(['roles.id', 'roles.name', 'roles.is_enabled', 'roles.description', 'roles.uuid'])
            ->setConfigurableAreas([
                'before-toolbar' => 'security.access-control.partials.datatable-modal',
            ])->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make(__('Role'), 'display_name')
                ->view('security.access-control.partials.info')
                ->sortable()
                ->searchable(),
        ];
    }

    /**
     * The base query.
     */
    public function builder(): Builder
    {
        return Model::query()
            ->where('name', '!=', 'superadmin')
            ->orderBy('is_enabled', 'desc')
            ->orderBy('created_at', 'desc');
    }
}
