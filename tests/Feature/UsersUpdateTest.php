<?php

it('has usersupdate page', function () {
    $response = $this->get('/usersupdate');

    $response->assertStatus(200);
});
