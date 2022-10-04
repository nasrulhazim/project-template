<?php

it('has screens//welcome page', function () {
    $response = $this->get('/screens//welcome');

    $response->assertStatus(200);
});
