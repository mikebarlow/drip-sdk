<?php

namespace Snscripts\Drip\Api\Actions\Events;

use Snscripts\Drip\Items\Event;
use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Api\Actions\AbstractAction;

class Record extends AbstractAction
{
    /**
     * constructor - save objects
     *
     */
    public function __construct(Subscriber $Subscriber, Event $Event)
    {
        $this->Subscriber = $Subscriber;
        $this->Event = $Event;

        $id = $this->Subscriber->id;
        $email = $this->Subscriber->email;

        if (! empty($id)) {
            $this->subscriberInfo = ['id' => $id];
        } elseif (! empty($email)) {
            $this->subscriberInfo = ['email' => $email];
        } else {
            throw new \Snscripts\Drip\Exceptions\SubscriberInfo(
                'A subscribers email or ID is required to record an event action.'
            );
        }

        $eventAction = $this->Event->action;
        if (empty($eventAction)) {
            throw new \Snscripts\Drip\Exceptions\EventInfo(
                'An event action is required when recording to a subscriber.'
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
        return ':accountId/events';
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
                'events' => [
                    array_merge_recursive(
                        $this->subscriberInfo,
                        $this->Event->toArray()
                    )
                ]
            ]
        ];
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
                'Action "' . $this->Event->action .
                '" has been recorded on subscriber "' . $this->Subscriber->email . '"'
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::ERROR,
            'There was an error while recording the action "' . $this->Event->action .
            '" on the user (' . $this->Subscriber->email . ')'
        );
    }
}
