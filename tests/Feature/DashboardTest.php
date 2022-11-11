<?php

it('has dashboard page', function () {
    $response = login()->get('/dashboard');

    $response->assertStatus(200);
});
