<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'uuid') && is_null($model->uuid)) {
                $model->uuid = Str::orderedUuid();
            }    
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getUuidColumnName();
    }

    /**
     * Get UUID Column Name.
     */
    public function getUuidColumnName(): string
    {
        return isset($this->uuid_column) ? $this->uuid_column : 'uuid';
    }

    /**
     * Scope a query to only include popular users.
     */
    public function scopeUuid(Builder $query, $value): Builder
    {
        return $query->where($this->getUuidColumnName(), $value);
    }
}
