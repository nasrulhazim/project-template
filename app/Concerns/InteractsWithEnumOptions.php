<?php

namespace App\Concerns;

trait InteractsWithEnumOptions
{
    /**
     * Generate an array of options with value, label, and description for select inputs
     */
    public static function options(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'description' => $case->description(),
        ], self::cases());
    }
}
