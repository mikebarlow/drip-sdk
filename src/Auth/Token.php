<?php

namespace TutoraUK\Drip\Auth;

use TutoraUK\Drip\Auth\AbstractAuth;

class Token extends AbstractAuth
{
    /**
     * Build the auth object into options for guzzle
     * guzzle supports basic auth, use 'auth' in Guzzle
     *
     * @return array
     */
    public function build()
    {
        return [
            'auth' => [
                $this->token,
                ''
            ]
        ];
    }
}
