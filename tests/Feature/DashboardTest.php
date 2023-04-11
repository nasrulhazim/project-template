<?php

use Illuminate\Support\Facades\Artisan;

beforeEach(fn() => Artisan::call('migrate:fresh'));

it('has dashboard page', function () {
    $response = login()->get('/dashboard');

    $response->assertStatus(200);
});
