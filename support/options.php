<?php

// use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Collection;

if (! function_exists('to_options')) {
    function to_options(array|Collection $array): array
    {

        if (! $array instanceof Collection) {
            $array = Collection::make($array);
        }

        return $array
            ->prepend('Any', 0)
            ->toArray();
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
