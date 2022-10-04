<?php

it('has welcome page', function () {
    $response = $this->get('/welcome');

    $response->assertStatus(200);
});
