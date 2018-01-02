<?php

namespace Snscripts\Drip\Auth;

use Snscripts\Drip\Auth\AbstractAuth;

class Oauth extends AbstractAuth
{
    /**
     * Build the auth object into options for guzzle
     * Guzzle does not support bearer out the box, build auth header manually
     *
     * @return array
     */
    public function build()
    {
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token
            ]
        ];
    }
}
