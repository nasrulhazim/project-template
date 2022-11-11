<?php

it('has welcome page', function () {
    $response = $this->get(route('welcome'));

    $response->assertStatus(200);
});
