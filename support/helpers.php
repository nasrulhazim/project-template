<?php

if (! function_exists('require_all_in')) {
    /**
     * Require all files in the given path.
     *
     * @param string $path File path pattern. eg. routes/web/*.php
     * @return void
     */
    function require_all_in(string $path): void
    {
        collect(glob($path))
            ->each(function ($path) {
                if (basename($path) !== basename(__FILE__)) {
                    require $path;
                }
            });
    }
}

require_all_in(__DIR__.'/*.php');
