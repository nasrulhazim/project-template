<?php

it('has usersindex page', function () {
    $response = $this->get('/usersindex');

    $response->assertStatus(200);
});
