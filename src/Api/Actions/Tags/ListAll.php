<?php

namespace TutoraUK\Drip\Api\Actions\Tags;

use TutoraUK\Drip\Items\Tag;
use TutoraUK\Drip\Api\Actions\AbstractAction;

class ListAll extends AbstractAction
{
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
        return ':accountId/tags';
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
     * @return TutoraUK\Result|Result
     */
    public function processResponse($Response)
    {
        $body = $this->getBody($Response);

        if (count($body['tags']) > 0) {
            $Tags = [];
            foreach ($body['tags'] as $tag) {
                $Tags[] = new Tag([
                    'name' => $tag
                ]);
            }

            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::FOUND,
                count($Tags) . ' tags found',
                [],
                [
                    'tags' => new \Cartalyst\Collections\Collection($Tags),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::NOT_FOUND,
            'No Tags found'
        );
    }
}
