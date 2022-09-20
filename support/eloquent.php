<?php

use App\Exceptions\ThrowException;
use Illuminate\Support\Facades\Cache;

if (! function_exists('get_model_from_uuid')) {
    function get_model_from_uuid(string $uuid, string $class)
    {
        ThrowException::unless(class_exists($class), null, "$class did not exists");

        $key = str($class)->kebab()->toString().'.'.$uuid;

        return Cache::remember($key, now()->addMinute(), fn () => $class::whereUuid($uuid)->firstOrFail());
    }
}
