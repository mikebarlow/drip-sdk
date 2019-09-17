<?php

namespace TutoraUK\Drip\Api\Actions\Events;

use TutoraUK\Drip\Api\Actions\AbstractAction;

class RecordEvents extends AbstractAction
{
    /**
     * @param array $Events
     */
    public function __construct(array $Events)
    {
        $this->Events = $Events;
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
        return ':accountId/events/batches';
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
                'batches' => [
                    [
                        'events' => $this->Events,
                    ],
                ],
            ],
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
        if ($Response->getStatusCode() === 201) {
            return \TutoraUK\Result\Result::success(
                \TutoraUK\Result\Result::SAVED,
                'Actions has been recorded'
            );
        }

        return \TutoraUK\Result\Result::fail(
            \TutoraUK\Result\Result::ERROR,
            'There was an error while recording actions'
        );
    }
}
