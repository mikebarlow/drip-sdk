<?php

namespace Snscripts\Drip;

use Snscripts\GetSet\GetSet;
use GuzzleHttp\ClientInterface;
use Snscripts\Drip\Auth\AbstractAuth;

class Drip
{
    use GetSet;

    /**
     * constructor - setup HTTP Package
     *
     * @param ClientInterface $http Guzzle Package
     * @param AbstractAuth $auth (Optional)
     */
    public function __construct(ClientInterface $http, AbstractAuth $auth = null)
    {
        $this->setAllData(
            $this->dripDefaults()
        );

        $this->http = $http;

        if (! is_null($auth)) {
            $this->setAuth($auth);
        }
    }

    /**
     * Define all the default values
     *
     * @return array
     */
    public function dripDefaults()
    {
        return [
            'apiUrl' => 'https://api.getdrip.com/v2',
            'userAgent' => 'Your App Name (www.example.com)',
        ];
    }

    /**
     * Set the authentication type to use
     *
     * @param AbstractAuth $auth
     * @return void
     */
    public function setAuth(AbstractAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * set the Drip Account Number
     *
     * @param int $accountId
     */
    public function setAccountId($accountId)
    {
        if (empty($accountId)) {
            throw new \Snscripts\Drip\Exceptions\EmptyAccountId('Your account id must be filled in');
        }

        $this->accountId = $accountId;
    }
}
