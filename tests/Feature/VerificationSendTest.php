<?php

it('has verificationsend page', function () {
    $response = $this->get('/verificationsend');

    $response->assertStatus(200);
});
