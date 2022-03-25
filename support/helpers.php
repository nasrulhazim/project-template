<?php

collect(glob(__DIR__.'/*.php'))
    ->each(function ($path) {
        if (basename($path) !== basename(__FILE__)) {
            require $path;
        }
    });
