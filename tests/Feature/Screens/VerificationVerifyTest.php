<?php

it('has screens//verificationverify page', function () {
    $response = $this->get('/screens//verificationverify');

    $response->assertStatus(200);
});
