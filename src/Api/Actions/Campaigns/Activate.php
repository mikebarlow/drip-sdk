<?php

namespace Snscripts\Drip\Api\Actions\Campaigns;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Api\Actions\AbstractAction;

class Activate extends AbstractAction
{
    /**
     * constrcutor - fetch the Campaign object
     *
     */
    public function __construct(Campaign $Campaign)
    {
        $this->Campaign = $Campaign;

        $id = $this->Campaign->id;

        if (empty($id)) {
            throw new \Snscripts\Drip\Exceptions\CampaignInfo(
                'A Campaign ID is required to activate the campaign.'
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
        return 'POST';
    }

    /**
     * return the constructed API endpoint
     *
     * @return string $endpointUrl
     */
    public function getEndpointUrl()
    {
        return ':accountId/campaigns/' . $this->Campaign->id . '/activate';
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
        if ($Response->getStatusCode() === 204) {
            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::SAVED,
                'Campaign (' . $this->Campaign->id . ') has been activated'
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::FAILED,
            'Failed to activate Campaign (' . $this->Campaign->id . ')'
        );
    }
}
