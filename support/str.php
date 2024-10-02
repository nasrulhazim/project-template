<?php

if (! function_exists('str_abbrv')) {
    function str_abbrv(string $value, int $max_characters = 4): string
    {

        $value = preg_replace('/[^a-zA-Z0-9\s]/', '', $value);

        if (empty($value)) {
            return '';
        }

        // Remove non-alphanumeric characters and convert to uppercase
        $value = strtoupper($value);

        // Split the name into words
        $words = explode(' ', $value);

        // Initialize abbreviation variable
        $abbreviation = '';

        // Iterate through words to get the first letter of each word
        $count = 0;
        foreach ($words as $word) {
            if ($count >= $max_characters) {
                break; // Limit reached, break loop
            }
            $abbreviation .= substr($word, 0, $max_characters);
            $count++;
        }

        return $abbreviation;
    }
}
