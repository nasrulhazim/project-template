<?php

it('has screens//verificationnotice page', function () {
    $response = $this->get('/screens//verificationnotice');

    $response->assertStatus(200);
});
