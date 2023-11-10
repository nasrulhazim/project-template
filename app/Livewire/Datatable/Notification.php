<?php

namespace App\Livewire\Datatable;

use App\Models\Notification as Model;
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

    /**
     * Set any configuration options
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    /**
     * The array defining the columns of the table.
     */
    public function columns(): array
    {
        return [
            Column::make(__('Message'), 'data')->sortable()->searchable(),
            Column::make(__('Received at'), 'created_at')->sortable()->searchable(),
            Column::make(__('Read at'), 'read_at')->sortable()->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Model::forUser(auth()->user());
    }

    public function markAsRead()
    {
        if ($this->getSelectedCount()) {
            Model::forUser(auth()->user())->whereIn('id', $this->selectedKeys)->update(['read_at' => now()]);
        }

        $this->clearSelected();
    }

    public function markAsUnread()
    {
        if ($this->getSelectedCount()) {
            Model::forUser(auth()->user())->whereIn('id', $this->selectedKeys)->update(['read_at' => null]);
        }

        $this->clearSelected();
    }
}
