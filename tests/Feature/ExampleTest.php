<?php

it('redirects guests to login on the root route', function () {
    $this->get('/')->assertRedirect(route('login'));
});
