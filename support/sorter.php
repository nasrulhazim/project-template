<?php

if (! function_exists('sort_json_by_key')) {
    function sort_json_by_key(string $input): string|bool
    {
        // Check if the input is a valid file path
        $jsonData = file_exists($input) ? file_get_contents($input) : $input;

        // Decode the JSON data into an associative array
        $dataArray = json_decode($jsonData, true);

        // Check for JSON decoding errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            exit('Error decoding JSON: '.json_last_error_msg());
        }

        // Sort the array by keys
        ksort($dataArray);

        // Re-encode the sorted array back to JSON
        $sortedJsonData = json_encode($dataArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        // Check for JSON encoding errors
        if ($sortedJsonData === false) {
            exit('Error encoding sorted data: '.json_last_error_msg());
        }

        // If the input was a file path, save the sorted JSON back to the file
        if (file_exists($input)) {
            file_put_contents($input, $sortedJsonData);

            return true;
        }

        // Otherwise, return the sorted JSON content
        return $sortedJsonData;
    }

}
