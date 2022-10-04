<?php

it('has dashboard page', function () {
    $response = $this->get('/dashboard');

    $response->assertStatus(200);
});
