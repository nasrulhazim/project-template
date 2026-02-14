<?php

namespace App\Livewire\Datatable;

use App\Concerns\InteractsWithDatatable;
use App\Models\Audit as Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class AuditTrail extends Component
{
    use InteractsWithDatatable;

    public function query(): Builder
    {
        return Model::query()->with(['user']);
    }

    public function columns(): array
    {
        return [
            [
                'key' => 'event',
                'label' => __('Event'),
                'sortable' => true,
                'searchable' => true,
                'view' => 'components.badge',
            ],
            [
                'key' => 'user.name',
                'label' => __('User'),
                'sortable' => false,
                'searchable' => true,
            ],
            [
                'key' => 'ip_address',
                'label' => __('IP Address'),
                'sortable' => true,
                'searchable' => true,
            ],
            [
                'key' => 'created_at',
                'label' => __('Created At'),
                'sortable' => true,
                'searchable' => true,
                'format' => fn ($value) => Carbon::parse($value)->format('d-m-Y H:i:s'),
            ],
            [
                'key' => 'url',
                'label' => __('URL'),
                'sortable' => true,
                'searchable' => true,
                'format' => fn ($value) => str_replace(config('app.url'), '', $value),
            ],
            [
                'key' => 'auditable_type',
                'label' => __('Type'),
                'sortable' => true,
                'searchable' => true,
                'format' => fn ($value) => class_basename($value),
            ],
            [
                'key' => 'uuid',
                'label' => __('Actions'),
                'view' => 'security.audit-trail.partials.datatable-actions',
            ],
        ];
    }

    public function filters(): array
    {
        return [
            [
                'key' => 'event',
                'label' => __('Event'),
                'type' => 'select',
                'options' => [
                    'created' => __('Created'),
                    'updated' => __('Updated'),
                    'deleted' => __('Deleted'),
                ],
                'query' => fn (Builder $query, $value) => $query->where('event', $value),
            ],
            [
                'key' => 'type',
                'label' => __('Type'),
                'type' => 'select',
                'options' => audit_type_options(),
                'query' => fn (Builder $query, $value) => $query->where('auditable_type', $value),
            ],
            [
                'key' => 'from',
                'label' => __('Date From'),
                'type' => 'date',
                'query' => fn (Builder $query, $value) => $query->whereDate('audits.created_at', '>=', $value),
            ],
            [
                'key' => 'to',
                'label' => __('Date To'),
                'type' => 'date',
                'query' => fn (Builder $query, $value) => $query->whereDate('audits.created_at', '<=', $value),
            ],
        ];
    }

    public function defaultSort(): array
    {
        return ['created_at' => 'desc'];
    }

    public function render()
    {
        return view('livewire.datatable.audit-trail');
    }
}
