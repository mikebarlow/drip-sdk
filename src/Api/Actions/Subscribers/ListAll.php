<?php

namespace TutoraUK\Drip\Api\Actions\Subscribers;

use TutoraUK\Drip\Items\Subscriber;
use TutoraUK\Drip\Api\Filters\QueryFilter;
use TutoraUK\Drip\Api\Actions\AbstractAction;

class ListAll extends AbstractAction
{
    /**
     * constrcutor - save the query filter object
     *
     */
    public function __construct(QueryFilter $QueryFilter)
    {
        $this->QueryFilter = $QueryFilter;
    }

    /**
     * return the method type to use
     *
     * @return string $method
     */
    public function getMethodType()
    {
        return 'GET';
    }

    /**
     * return the constructed API endpoint
     *
     * @return string $endpointUrl
     */
    public function getEndpointUrl()
    {
        return ':accountId/subscribers';
    }

    /**
     * return an array of request options - useful for post data
     *
     * @link http://docs.guzzlephp.org/en/stable/request-options.html
     *
     * @return array
     */
    public function getRequestOptions()
    {
        return $this->QueryFilter->toQueryString();
    }

    /**
     * process the response from the guzzle request
     *
     * @param GuzzleHttp\Psr7\Response $Response
     * @return TutoraUK\Result|Result
     */
    public function processResponse($Response)
    {
        $body = $this->getBody($Response);

        if (count($body['subscribers']) > 0) {
            $Subscribers = [];
            foreach ($body['subscribers'] as $subscriber) {
                $Subscribers[] = new Subscriber($subscriber);
            }

            return \TutoraUK\Result\Result::success(
                \TutoraUK\Result\Result::FOUND,
                count($Subscribers) . ' Subscribers found',
                [],
                [
                    'subscribers' => new \Cartalyst\Collections\Collection($Subscribers),
                ]
            );
        }

        return \TutoraUK\Result\Result::fail(
            \TutoraUK\Result\Result::NOT_FOUND,
            'No Subscribers found'
        );
    }
}
