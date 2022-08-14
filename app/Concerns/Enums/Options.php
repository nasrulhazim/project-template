<?php

namespace App\Concerns\Enums;

// 1. Potentially there's only some values/labels overwritten. Need to tackle that as well.
// 2. If values method values() / labels() overwrite, both method require to be overwrite 
// in order this feature to work well.
trait Options
{
    public static function options(): array
    {
        $values = count(static::values()) > 0 ? static::values() : static::toValues();
        $labels = count(static::labels()) > 0 ? static::labels() : static::toLabels();
        
        return to_options(
            array_combine(
                $values, $labels
            )
        );
    }
}
