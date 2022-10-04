<?php

it('has userscreate page', function () {
    $response = $this->get('/userscreate');

    $response->assertStatus(200);
});
