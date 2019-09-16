<?php

namespace TutoraUK\Drip\Api\Actions\Subscribers;

use TutoraUK\Drip\Items\Campaign;
use TutoraUK\Drip\Items\Subscriber;
use TutoraUK\Drip\Api\Actions\AbstractAction;

class Subscribe extends AbstractAction
{
    /**
     * constrcutor - save the Subscriber object
     *
     */
    public function __construct(Subscriber $Subscriber, Campaign $Campaign)
    {
        $this->Subscriber = $Subscriber;
        $this->Campaign = $Campaign;

        $email = $this->Subscriber->email;
        if (empty($email)) {
            throw new \TutoraUK\Drip\Exceptions\SubscriberInfo(
                'A subscribers email is required to subscribe them to a campaign.'
            );
        }

        $campaignId = $this->Campaign->id;
        if (empty($campaignId)) {
            throw new \TutoraUK\Drip\Exceptions\CampaignInfo('A Campaign ID is required to subscribe a user.');
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

        if ($Response->getStatusCode() === 201 && count($body['subscribers']) > 0) {
            return \TutoraUK\Result\Result::success(
                \TutoraUK\Result\Result::SAVED,
                'Subscriber (' . $this->Subscriber->email .
                ') has been subscribed to a campaign (' . $this->Campaign->id . ')',
                [],
                [
                    'subscriber' => new Subscriber($body['subscribers']['0']),
                ]
            );
        }

        return \TutoraUK\Result\Result::fail(
            \TutoraUK\Result\Result::ERROR,
            'There was an error while subscribing the user (' . $this->Subscriber->email .
            ') to the campaign (' . $this->Campaign->id . ')'
        );
    }
}
