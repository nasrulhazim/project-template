<?php

it('has screens//usersshow page', function () {
    $response = $this->get('/screens//usersshow');

    $response->assertStatus(200);
});
