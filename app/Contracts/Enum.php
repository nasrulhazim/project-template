<?php

namespace App\Contracts;

interface Enum
{
    /**
     * Get the label for the status.
     */
    public function label(): string;

    /**
     * Get the description for the status.
     */
    public function description(): string;

    /**
     * Generate an array of options with value, label, and description for select inputs.
     */
    public static function options(): array;
}
