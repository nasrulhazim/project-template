<?php

if (! function_exists('is_valid_json')) {
    function is_valid_json($value)
    {
        if (is_array($value)) {
            return false;
        }

        $json = json_decode($value, JSON_OBJECT_AS_ARRAY);

        return json_last_error() === JSON_ERROR_NONE && is_array($json);
    }
}
