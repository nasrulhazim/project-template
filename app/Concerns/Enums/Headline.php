<?php 

namespace App\Concerns\Enums;

trait Headline 
{
    /**
     * @return string[]|int[]
     */
    public static function toLabels(): array
    {
        $values = array_keys(static::toArray());
        foreach ($values as $key => $value) {
            $values[$key] = __(
                str($value)->headline()->toString()
            );
        }
        return $values;
    }
}