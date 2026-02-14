<?php

namespace App\Livewire\Datatable;

use App\Concerns\InteractsWithDatatable;
use App\Models\Notification as Model;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Notification extends Component
{
    use InteractsWithDatatable;

    public function query(): Builder
    {
        return Model::forUser(auth()->user());
    }

    public function columns(): array
    {
        return [
            [
                'key' => 'data',
                'label' => __('Subject'),
                'sortable' => true,
                'format' => fn ($value) => data_get($value, 'subject'),
            ],
            [
                'key' => 'created_at',
                'label' => __('Received at'),
                'sortable' => true,
                'searchable' => true,
            ],
            [
                'key' => 'read_at',
                'label' => __('Read at'),
                'sortable' => true,
                'searchable' => true,
            ],
            [
                'key' => 'id',
                'label' => __('Actions'),
                'view' => 'notifications.datatable-actions',
            ],
        ];
    }

    public function bulkActions(): array
    {
        return [
            'markAsRead' => 'Mark as Read',
            'markAsUnread' => 'Mark as Unread',
        ];
    }

    public function markAsRead(): void
    {
        if (count($this->selected) > 0) {
            Model::forUser(auth()->user())
                ->whereIn('id', $this->selected)
                ->update(['read_at' => now()]);
        }
    }

    public function markAsUnread(): void
    {
        if (count($this->selected) > 0) {
            Model::forUser(auth()->user())
                ->whereIn('id', $this->selected)
                ->update(['read_at' => null]);
        }
    }

    public function render()
    {
        return view('livewire.datatable.notification');
    }
}
