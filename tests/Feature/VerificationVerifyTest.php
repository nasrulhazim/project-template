<?php

it('has verificationverify page', function () {
    $response = $this->get('/verificationverify');

    $response->assertStatus(200);
});
