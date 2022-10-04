<?php

it('has notifications page', function () {
    $response = $this->get('/notifications');

    $response->assertStatus(200);
});
