<?php

namespace Snscripts\Drip\Api\Actions\Campaigns;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\AbstractAction;

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
        return ':accountId/campaigns';
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
     * @return Snscripts\Result|Result
     */
    public function processResponse($Response)
    {
        $body = $this->getBody($Response);

        if (count($body['campaigns']) > 0) {
            $Campaigns = [];
            foreach ($body['campaigns'] as $campaign) {
                $Campaigns[] = new Campaign($campaign);
            }

            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::FOUND,
                count($Campaigns) . ' Campaigns found',
                [],
                [
                    'campaigns' => new \Cartalyst\Collections\Collection($Campaigns),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::NOT_FOUND,
            'No Campaigns found'
        );
    }
}
