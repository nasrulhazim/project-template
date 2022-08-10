<?php

use Illuminate\Database\Eloquent\Builder;

if (! function_exists('dumpSql')) {
    function dumpSql(Builder $builder)
    {
        return array_reduce($builder->getBindings(), function ($sql, $binding) {
            return preg_replace('/\?/', is_numeric($binding) ? $binding : "'".$binding."'", $sql, 1);
        }, $builder->toSql());
    }
}

if (! function_exists('logDumpSql')) {
    function logDumpSql(Builder $query)
    {
        logger()->debug(dumpSql($query));
    }
}
