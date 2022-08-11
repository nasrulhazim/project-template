<?php

namespace App\Concerns;

trait InteractsWithExceptions
{
    public static function throwIf(bool $condition, string $method, ...$args)
    {
        if (! $condition) {
            if (method_exists(__CLASS__, $method)) {
                throw self::$method(...$args);
            }

            throw new self("Invalid exception method $method");
        }
    }

    public static function throwUnless(bool $condition, string $method, ...$args)
    {
        self::throwIf(! $condition, $method, ...$args);
    }
}
