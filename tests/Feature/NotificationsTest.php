<?php

it('has notifications page', function () {
    $response = login()->get('/notifications');

    $response->assertStatus(200);
});
