<?php

it('redirects to login when user is guest', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
