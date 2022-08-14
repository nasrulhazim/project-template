<?php

if (! function_exists('breadcrumb_enabled')) {
    function breadcrumb_enabled()
    {
        return config('breadcrumbs.enabled');
    }
}
