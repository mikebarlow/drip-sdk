<?php

namespace TutoraUK\Drip\Api\Actions\Subscribers;

use TutoraUK\Drip\Items\Campaign;
use TutoraUK\Drip\Items\Subscriber;
use TutoraUK\Drip\Api\Actions\AbstractAction;

class Unsubscribe extends AbstractAction
{
    /**
     * constrcutor - save the Subscriber object
     *
     */
    public function __construct(Subscriber $Subscriber, Campaign $Campaign = null)
    {
        $this->Subscriber = $Subscriber;
        $this->Campaign = $Campaign;

        $id = $this->Subscriber->id;
        $email = $this->Subscriber->email;

        if (! empty($id)) {
            $this->urlToken = $id;
        } elseif (! empty($email)) {
            $this->urlToken = $email;
        } else {
            throw new \TutoraUK\Drip\Exceptions\SubscriberInfo(
                'A subscribers email or ID is required to remove their subscriptions.'
            );
        }

        $this->urlQuery = [];
        if ($Campaign !== null) {
            $campaignId = $this->Campaign->id;

            if (! empty($campaignId)) {
                $this->urlQuery = [
                    'campaign_id' => $this->Campaign->id
                ];
            } else {
                throw new \TutoraUK\Drip\Exceptions\CampaignInfo(
                    'A Campaign ID is required to remove a subscriber from a specific campaign.'
                );
            }
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
        return ':accountId/subscribers/' . $this->urlToken . '/remove';
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
            'query' => $this->urlQuery
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

        if ($this->Campaign !== null) {
            $msg = ' a campaign (' . $this->Campaign->id . ')';
        } else {
            $msg = ' all campaigns';
        }

        if ($Response->getStatusCode() === 200 && count($body['subscribers']) > 0) {
            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::DELETED,
                'Subscriber (' . $this->Subscriber->email .
                ') has been unsubscribed from ' . $msg,
                [],
                [
                    'subscriber' => new Subscriber($body['subscribers']['0']),
                ]
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::ERROR,
            'There was an error while unsubscribing the user (' .
            $this->Subscriber->email . ') from ' . $msg
        );
    }
}
