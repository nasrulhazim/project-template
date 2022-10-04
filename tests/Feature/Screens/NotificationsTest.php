<?php

it('has screens//notifications page', function () {
    $response = $this->get('/screens//notifications');

    $response->assertStatus(200);
});
