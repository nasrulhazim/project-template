<?php

use Bekwoh\LaravelMediaSecure\Http\Controllers\MediaController;

return [
    /**
     * Spatie's Model Class Name
     */
    'model' => \Spatie\MediaLibrary\MediaCollections\Models\Media::class,

    /**
     * Spatie's Model Media Policy
     */
    'policy' => \Bekwoh\LaravelMediaSecure\Policies\MediaPolicy::class,

    /**
     * Controller to manage access to the media.
     */
    'controller' => [
        MediaController::class, '__invoke',
    ],

    /**
     * Middleware want to apply to the media route.
     */
    'middleware' => [
        'auth:sanctum', //'verified',
    ],

    /**
     * Media URI.
     */
    'prefix' => 'media',

    /**
     * Route name.
     */
    'route_name' => 'media',
];
