<?php

namespace Snscripts\Drip\Api\Actions\Subscribers;

use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Api\Actions\AbstractAction;

class Fetch extends AbstractAction
{
    /**
     * constrcutor - save the Subscriber object
     *
     */
    public function __construct(Subscriber $Subscriber)
    {
        $this->Subscriber = $Subscriber;

        $id = $this->Subscriber->id;
        $email = $this->Subscriber->email;

        if (! empty($id)) {
            $this->urlToken = $id;
        } elseif (! empty($email)) {
            $this->urlToken = $email;
        } else {
            throw new \Snscripts\Drip\Exceptions\SubscriberInfo('A subscribers email or ID is required to fetch their data.');
        }
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
        return ':accountId/subscribers/' . $this->urlToken;
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
        return [];
    }

    /**
     * process the response from the guzzle request
     *
     * @param GuzzleHttp\Psr7\Response $Response
     * @return Snscripts\Result|Result
     */
    public function processResponse($Response)
    {
        $body = $this->getBody($Response);

        if (count($body['subscribers']) > 0) {
            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::FOUND,
                'Subscriber details found.',
                [],
                [
                    'subscriber' => new Subscriber($body['subscribers']['0']),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::NOT_FOUND,
            'No Subscribers found'
        );
    }
}
