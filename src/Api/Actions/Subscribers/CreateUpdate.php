<?php

namespace TutoraUK\Drip\Api\Actions\Subscribers;

use TutoraUK\Drip\Items\Subscriber;
use TutoraUK\Drip\Api\Actions\AbstractAction;

class CreateUpdate extends AbstractAction
{
    /**
     * constrcutor - save the Subscriber object
     *
     */
    public function __construct(Subscriber $Subscriber)
    {
        $this->Subscriber = $Subscriber;
    }

    /**
     * return the method type to use
     *
     * @return string $method
     */
    public function getMethodType()
    {
        return 'POST';
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
        return [
            'json' => [
                'subscribers' => [
                    $this->Subscriber->toArray()
                ]
            ]
        ];
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
            return \TutoraUK\Result\Result::success(
                \TutoraUK\Result\Result::FOUND,
                'Subscriber created / updated',
                [],
                [
                    'subscriber' => new Subscriber($body['subscribers']['0']),
                ]
            );
        }

        return \TutoraUK\Result\Result::fail(
            \TutoraUK\Result\Result::ERROR,
            'There was an error while attempting to create / update the subscriber'
        );
    }
}
