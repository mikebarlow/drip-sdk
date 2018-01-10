<?php

namespace Snscripts\Drip\Api\Actions\Campaigns;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\AbstractAction;

class Subscribers extends AbstractAction
{
    /**
     * Constructor
     *
     * @param Campaign $Campaign
     * @param QueryFilter $QueryFilter|null
     */
    public function __construct(Campaign $Campaign, QueryFilter $QueryFilter)
    {
        $this->Campaign = $Campaign;
        $this->QueryFilter = $QueryFilter;

        $id = $this->Campaign->id;

        if (empty($id)) {
            throw new \Snscripts\Drip\Exceptions\CampaignInfo(
                'A Campaign ID is required to fetch the campaign data.'
            );
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
        return ':accountId/campaigns/' . $this->Campaign->id . '/subscribers';
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

        if (count($body['subscribers']) > 0) {
            $Subscribers = [];
            foreach ($body['subscribers'] as $subscriber) {
                $Subscribers[] = new Subscriber($subscriber);
            }

            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::FOUND,
                count($Subscribers) . ' Subscribers found',
                [],
                [
                    'subscribers' => new \Cartalyst\Collections\Collection($Subscribers),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::NOT_FOUND,
            'No Subscribers found'
        );
    }
}
