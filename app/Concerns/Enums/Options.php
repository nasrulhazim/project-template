<?php

namespace App\Concerns\Enums;

trait Options
{
    public static function options(): array
    {
        return to_options(array_combine(
            self::values(),
            self::labels()
        ));
    }
}
