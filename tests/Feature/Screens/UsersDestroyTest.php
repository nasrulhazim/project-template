<?php

it('has screens//usersdestroy page', function () {
    $response = $this->get('/screens//usersdestroy');

    $response->assertStatus(200);
});
