<?php

if (! function_exists('require_all_in')) {
    function require_all_in(string $path)
    {
        collect(glob($path))
            ->each(function ($path) {
                if (basename($path) !== basename(__FILE__)) {
                    require $path;
                }
            });
    }
}
