<?php

it('has screens//usersstore page', function () {
    $response = $this->get('/screens//usersstore');

    $response->assertStatus(200);
});
