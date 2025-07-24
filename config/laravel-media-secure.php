<?php

use CleaniqueCoders\LaravelMediaSecure\Http\Controllers\MediaController;

return [
    /**
     * Spatie's Model Class Name
     */
    'model' => \Spatie\MediaLibrary\MediaCollections\Models\Media::class,

    /**
     * Spatie's Model Media Policy
     */
    'policy' => \CleaniqueCoders\LaravelMediaSecure\Policies\MediaPolicy::class,

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
        'auth:sanctum', // 'verified',
    ],

    /**
     * Media URI.
     */
    'prefix' => 'media',

    /**
     * Route name.
     */
    'route_name' => 'media',

    /**
     * By default, all media require to be login.
     */
    'require_auth' => env('LARAVEL_MEDIA_SECURE_REQUIRE_AUTH', true),

    /**
     * Strict mode - by default all media's model require policy.
     */
    'strict' => env('LARAVEL_MEDIA_SECURE_STRICT', true),
];
