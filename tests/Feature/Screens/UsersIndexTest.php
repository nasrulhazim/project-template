<?php

it('has screens//usersindex page', function () {
    $response = $this->get('/screens//usersindex');

    $response->assertStatus(200);
});
