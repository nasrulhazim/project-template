<?php

if (! function_exists('flash')) {
    function flash(string $variant, string $message): void
    {
        session()->flash('message', json_encode(flash_variant($variant)).'|'.$message);
    }
}

if (! function_exists('flash_variant')) {
    /**
     * Get Flash classes on variant.
     *
     * @param string $variant
     * @return array <string, string>
     */
    function flash_variant(string $variant): array
    {
        return match ($variant) {
            'success' => [
                'border' => 'border-green-500',
                'bg' => 'bg-green-100',
                'text' => 'text-green-500',
            ],
            'info' => [
                'border' => 'border-blue-500',
                'bg' => 'bg-blue-100',
                'text' => 'text-blue-500',
            ],
            'danger' => [
                'border' => 'border-red-500',
                'bg' => 'bg-red-100',
                'text' => 'text-red-500',
            ],
            'error' => [
                'border' => 'border-red-500',
                'bg' => 'bg-red-100',
                'text' => 'text-red-500',
            ],
            'warning' => [
                'border' => 'border-orange-500',
                'bg' => 'bg-orange-100',
                'text' => 'text-orange-500',
            ],
            default => [
                'border' => 'border-slate-500',
                'bg' => 'bg-slate-100',
                'text' => 'text-slate-500',
            ]
        };
    }
}
