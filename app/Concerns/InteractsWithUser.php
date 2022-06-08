<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Schema;

trait InteractsWithUser
{
    public static function bootInteractsWithUser()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'user_id') && is_null($model->user_id)) {
                $model->user_id = auth()->user()->id;
            }
        });
    }
}
