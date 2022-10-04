<?php

it('has screens//userscreate page', function () {
    $response = $this->get('/screens//userscreate');

    $response->assertStatus(200);
});
