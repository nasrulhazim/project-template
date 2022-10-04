<?php

it('has usersedit page', function () {
    $response = $this->get('/usersedit');

    $response->assertStatus(200);
});
