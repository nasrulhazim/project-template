<?php

namespace App\Contracts;

interface Enum
{
    /**
     * Get the label for the status.
     *
     * @return string
     */
    public function label(): string;

    /**
     * Get the description for the status.
     *
     * @return string
     */
    public function description(): string;

    /**
     * Generate an array of options with value, label, and description for select inputs.
     *
     * @return array
     */
    public static function options(): array;
}
