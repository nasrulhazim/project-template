<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification as Model;

class Notification extends Model
{
    public function scopeForUser($query, User $user)
    {
        return $query
            ->where('notifiable_type', 'App\Models\User')
            ->where('notifiable_id', $user->id)
            ->orderBy('read_at', 'asc');
    }
}
