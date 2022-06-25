<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait InteractsWithToken
{
    public static function bootInteractsWithToken()
    {
        static::creating(function (Model $model) {
            if (Schema::hasColumn($model->getTable(), $model->getTokenColumn()) && is_null($model->{$model->getTokenColumn()})) {
                $model->{$model->getTokenColumn()} = Str::random(128);
            }
        });
    }

    /**
     * Get Token Column Name.
     */
    public function getTokenColumn(): string
    {
        return isset($this->token_column) ? $this->token_column : 'token';
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeToken(Builder $query, $value): Builder
    {
        return $query->where($this->getTokenColumn(), $value);
    }
}
