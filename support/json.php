<?php

if (! function_exists('is_valid_json')) {
    /**
     * Validate given JSON is valid.
     *
     * @param string $value
     * @return bool
     */
    function is_valid_json(string $value): bool
    {
        $json = json_decode(json: $value, flags: JSON_OBJECT_AS_ARRAY);

        return json_last_error() === JSON_ERROR_NONE && is_array($json);
    }
}
