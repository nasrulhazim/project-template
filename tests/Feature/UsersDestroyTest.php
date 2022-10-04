<?php

it('has usersdestroy page', function () {
    $response = $this->get('/usersdestroy');

    $response->assertStatus(200);
});
