<?php

if (! function_exists('flash')) {
    function flash(string $variant, string $message)
    {
        session()->flash('message', flash_variant($variant).'|'.$message);
    }
}

if (! function_exists('flash_variant')) {
    function flash_variant($variant)
    {
        return match ($variant) {
            'success' => 'green',
            'danger' => 'red',
            'error' => 'red',
            'warning' => 'orange',
            default => 'primary'
        };
    }
}
