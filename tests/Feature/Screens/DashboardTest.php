<?php

it('has screens//dashboard page', function () {
    $response = $this->get('/screens//dashboard');

    $response->assertStatus(200);
});
