<?php

// use Illuminate\Support\Facades\Cache;

if (! function_exists('to_options')) {
    function to_options(array $array): array
    {
        return array_merge([
            '' => __('Any'),
        ], $array);
    }
}

// if (! function_exists('custom_options')) {
//     function custom_options()
//     {
//         return Cache::remember('custom_options', 60, function () { // always cache it to improve performance
//             return [];
//         });
//     }
// }
