<?php

it('has screens//verificationsend page', function () {
    $response = $this->get('/screens//verificationsend');

    $response->assertStatus(200);
});
