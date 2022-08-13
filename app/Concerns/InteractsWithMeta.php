<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Schema;

trait InteractsWithMeta
{
    public static function bootInteractsWithMeta()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'meta') && is_null($model->meta)) {
                if(! $model->hasCast('meta', 'array')) {
                    $model->castAttribute('meta', 'array');
                }

                $model->meta = $model->defaultMeta();
            }
        });
    }

    public function defaultMeta()
    {
        return property_exists($this, 'default_meta') 
            ? $this->default_meta
            : [];
    }
}
