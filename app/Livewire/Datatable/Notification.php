<?php

namespace App\Livewire\Datatable;

use App\Models\Notification as Model;
use App\View\ActionColumn;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Notification extends DataTableComponent
{
    protected $model = Model::class;

    public array $bulkActions = [
        'markAsRead' => 'Mark as Read',
        'markAsUnread' => 'Mark as Unread',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make(__('Subject'), 'data')
                ->format(fn ($value) => data_get($value, 'subject'))
                ->sortable(),
            Column::make(__('Received at'), 'created_at')->sortable()->searchable(),
            Column::make(__('Read at'), 'read_at')->sortable()->searchable(),
            ActionColumn::make(__('Actions'), 'id')
                ->setView('notifications.datatable-actions'),
        ];
    }

    public function builder(): Builder
    {
        return Model::forUser(auth()->user());
    }

    public function markAsRead()
    {
        if ($this->getSelectedCount() !== 0) {
            Model::forUser(auth()->user())->whereIn('id', $this->getSelected())->update(['read_at' => now()]);
        }

        $this->clearSelected();
    }

    public function markAsUnread()
    {
        if ($this->getSelectedCount() !== 0) {
            Model::forUser(auth()->user())->whereIn('id', $this->getSelected())->update(['read_at' => null]);
        }

        $this->clearSelected();
    }
}
