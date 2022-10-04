<?php

it('has usersshow page', function () {
    $response = $this->get('/usersshow');

    $response->assertStatus(200);
});
