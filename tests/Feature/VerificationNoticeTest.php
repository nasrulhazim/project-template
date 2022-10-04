<?php

it('has verificationnotice page', function () {
    $response = $this->get('/verificationnotice');

    $response->assertStatus(200);
});
