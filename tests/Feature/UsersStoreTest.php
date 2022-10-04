<?php

it('has usersstore page', function () {
    $response = $this->get('/usersstore');

    $response->assertStatus(200);
});
