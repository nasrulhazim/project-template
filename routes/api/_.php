<?php

use App\Http\Controllers\Api\UserController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['middleware' => 'auth:sanctum'], function () use ($api) {
    $api->get('profile', UserController::class)->name('api.profile.show');
});
