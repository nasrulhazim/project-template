<?php

it('has screens//usersedit page', function () {
    $response = $this->get('/screens//usersedit');

    $response->assertStatus(200);
});
