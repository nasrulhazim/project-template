<?php

namespace App\Concerns;

trait InteractsWithExceptions
{
    public static function unless(bool $condition, ?string $method = null, ?string $message = null, ...$args)
    {
        return self::throwIf($condition, $method, $message, ...$args);
    }

    public static function throwIf(bool $condition, ?string $method = null, ?string $message = null, ...$args)
    {
        if (! $condition) {
            if ($method && method_exists(__CLASS__, $method)) {
                throw self::$method(...$args);
            }

            throw new self($message);
        }
    }

    public static function throwUnless(bool $condition, ?string $method = null, ?string $message = null, ...$args)
    {
        self::throwIf(! $condition, $method, $message, ...$args);
    }
}
