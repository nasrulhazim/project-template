<?php

namespace App\Http\Livewire;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NotificationTable extends DataTableComponent
{
    protected $model = Notification::class;

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
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make('Message', 'data')->sortable()->searchable(),
            Column::make('Received at', 'created_at')->sortable()->searchable(),
            Column::make('Read at', 'read_at')->sortable()->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Notification::forUser(auth()->user());
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.notification-table';
    }

    public function markAsRead()
    {
        if (count($this->selectedKeys)) {
            Notification::forUser(auth()->user())->whereIn('id', $this->selectedKeys)->update(['read_at' => now()]);
        }

        $this->resetAll();
    }

    public function markAsUnread()
    {
        if (count($this->selectedKeys)) {
            Notification::forUser(auth()->user())->whereIn('id', $this->selectedKeys)->update(['read_at' => null]);
        }

        $this->resetAll();
    }
}
