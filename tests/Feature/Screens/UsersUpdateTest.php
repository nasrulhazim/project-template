<?php

it('has screens//usersupdate page', function () {
    $response = $this->get('/screens//usersupdate');

    $response->assertStatus(200);
});
