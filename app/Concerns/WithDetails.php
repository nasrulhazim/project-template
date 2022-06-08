<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait WithDetails
{
    public function getDetails(): array
    {
        return isset($this->with_details)
            ? $this->with_details
            : [];
    }

    public function scopeWithDetails(Builder $query): Builder
    {
        return $query->with($this->getDetails());
    }
}
