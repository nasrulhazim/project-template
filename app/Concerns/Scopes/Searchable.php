<?php

namespace App\Concerns\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

trait Searchable
{
    /**
     * Apply a case-insensitive search to a query builder.
     *
     * @param  string|array  $field
     * @param  string  $keyword
     * @return Builder
     */
    public static function scopeSearch(Builder $query, string|array $fields, $keyword)
    {
        $keyword = strtolower($keyword);

        if (is_string($fields)) {
            $fields = Arr::wrap($fields);
        }

        foreach ($fields as $field) {
            $query->orWhereRaw('LOWER('.$field.') LIKE ?', ['%'.$keyword.'%']);
        }

        return $query;
    }
}
