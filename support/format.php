<?php

if (! function_exists('money_format')) {
    function money_format(float $value)
    {
        return number_format($value, 2, '.', ',');
    }
}
