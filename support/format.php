<?php

if (! function_exists('money_format')) {
    /**
     * Format given money given in string.
     *
     * @param float $value
     * @return string
     */
    function money_format(float $value): string
    {
        return number_format($value, 2, '.', ',');
    }
}
