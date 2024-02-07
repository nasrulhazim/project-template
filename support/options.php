<?php

// use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Collection;

if (! function_exists('to_options')) {
    function to_options(array|Collection $array): array
    {

        if (! $array instanceof Collection) {
            $array = Collection::make($array);
        }

        return $array
            ->prepend('Any', 0)
            ->toArray();
    }
}

use Illuminate\Support\Facades\Cache;

if (! function_exists('role_options')) {
    function role_options()
    {
        return Cache::remember('role_options', 30, function () {
            return collect(config('access-matrix.roles'))
                ->mapWithKeys(fn ($value, $key) => [$key => str($key)->headline()->toString()])
                ->reject(fn ($value, $key) => $key == 'superadmin')
                ->toArray();
        });
    }
}

if (! function_exists('audit_type_options')) {
    function audit_type_options()
    {
        return Cache::remember('audit_type_options', 30, function () {
            $models = [];

            $models = array_merge($models, glob(app_path('Models/*.php')));

            return collect($models)
                ->mapWithKeys(
                    fn ($value, $key) => [
                        str($value)
                            ->replace(app_path('Models/'), 'App/Models/')
                            ->replace('.php', '')
                            ->replace('/', '\\')
                            ->toString() => str($value)
                            ->replace(app_path('Models/'), '')
                            ->replace('.php', '')
                            ->headline()
                            ->replace('/', '')
                            ->toString()]
                )
                ->reject(fn ($value) => in_array($value, ['Audit', 'Base']))
                ->toArray();
        });
    }
}
