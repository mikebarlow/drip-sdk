<?php

namespace TutoraUK\Drip\Api\Actions\Events;

use TutoraUK\Drip\Items\Event;
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
        return ':accountId/event_actions';
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

        if (count($body['event_actions']) > 0) {
            $Events = [];
            foreach ($body['event_actions'] as $event) {
                $Events[] = new Event([
                    'action' => $event
                ]);
            }

            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::FOUND,
                count($Events) . ' Events found',
                [],
                [
                    'events' => new \Cartalyst\Collections\Collection($Events),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::NOT_FOUND,
            'No Events found'
        );
    }
}
