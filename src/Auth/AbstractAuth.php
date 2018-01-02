<?php

namespace Snscripts\Drip\Auth;

use Snscripts\GetSet\GetSet;
use Snscripts\Drip\Exceptions\EmptyToken;

abstract class AbstractAuth
{
    use GetSet;

    /**
     * constructor - save the token
     *
     * @param string $token
     */
    public function __construct($token)
    {
        if (empty($token)) {
            throw new EmptyToken('Auth token cannot be empty');
        }

        $this->token = $token;
    }

    /**
     * Build the auth object into options for guzzle
     *
     * @return array
     */
    abstract public function build();
}
