<?php

namespace TutoraUK\Drip\Api\Actions;

use Snscripts\GetSet\GetSet;

abstract class AbstractAction
{
    use GetSet;

    /**
     * return the method type to use
     *
     * @return string $method
     */
    abstract public function getMethodType();

    /**
     * return the constructed API endpoint
     *
     * @return string $endpointUrl
     */
    abstract public function getEndpointUrl();

    /**
     * return an array of request options - useful for post data
     *
     * @link http://docs.guzzlephp.org/en/stable/request-options.html
     *
     * @return array
     */
    abstract public function getRequestOptions();

    /**
     * process the response from the guzzle request
     *
     * @param GuzzleHttp\Psr7\Response $Response
     * @return TutoraUK\Result|Result
     */
    abstract public function processResponse($Response);

    /**
     * get the body from Guzzle response and decode json
     *
     * @param GuzzleHttp\Psr7\Response $Response
     * @return
     */
    public function getBody($Response)
    {
        return json_decode(
            $Response->getBody(),
            true
        );
    }
}
