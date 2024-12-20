<?php

namespace App\Livewire\Datatable;

use App\Models\Audit as Model;
use App\View\ActionColumn;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class AuditTrail extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('uuid')
            ->setEagerLoadAllRelationsEnabled()
            ->setAdditionalSelects([
                'audits.user_id',
                'audits.auditable_id',
                'audits.old_values',
                'audits.new_values',
                'audits.created_at',
            ])
            ->setDefaultSort('created_at', 'desc')
            ->setFilterLayoutSlideDown();
    }

    public function columns(): array
    {
        return [
            Column::make(__('Event'), 'event')
                ->view('components.badge')
                ->searchable()
                ->sortable(),
            Column::make(__('User'), 'user.name')
                ->searchable()
                ->sortable(),
            Column::make(__('IP Address'), 'ip_address')
                ->searchable()
                ->sortable(),
            Column::make(__('Created At'), 'created_at')
                ->format(fn ($value) => Carbon::parse($value)->format('d-m-Y H:i:s'))
                ->searchable()
                ->sortable(),
            Column::make(__('URL'), 'url')
                ->format(fn ($value) => str_replace(config('app.url'), '', $value))
                ->searchable()
                ->sortable(),
            Column::make(__('Type'), 'auditable_type')
                ->format(fn ($value) => class_basename($value))
                ->searchable()
                ->sortable(),
            ActionColumn::make(__('Actions'), 'uuid')
                ->form('')
                ->setView('security.audit-trail.partials.datatable-actions'),
        ];
    }

    /**
     * The base query.
     */
    public function builder(): Builder
    {
        return Model::query();
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Event')
                ->options([
                    'created' => __('Created'),
                    'updated' => __('Updated'),
                    'deleted' => __('Deleted'),
                ])
                ->filter(function (Builder $builder, $value) {
                    $builder->where('event', $value);
                }),
            SelectFilter::make(__('Type'), 'type')
                ->options(audit_type_options())
                ->filter(function (Builder $builder, $value) {
                    $builder->where('auditable_type', $value);
                }),
            DateFilter::make(__('Date From'), 'from')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('audits.created_at', '>=', $value);
                })->setFilterSlidedownColspan('2'),
            DateFilter::make(__('Date To'), 'to')
                ->filter(function (Builder $builder, string $value) {
                    $builder->whereDate('audits.created_at', '<=', $value);
                })->setFilterSlidedownColspan('2'),
        ];
    }
}
