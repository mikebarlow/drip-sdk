<?php

namespace Snscripts\Drip\Api\Actions\Tags;

use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Items\Tag as TagItem;
use Snscripts\Drip\Api\Actions\AbstractAction;

class RemoveTag extends AbstractAction
{
    /**
     * constrcutor - save the Subscriber object
     *
     */
    public function __construct(Subscriber $Subscriber, TagItem $Tag)
    {
        $this->Subscriber = $Subscriber;
        $this->Tag = $Tag;

        $email = $this->Subscriber->email;
        if (empty($email)) {
            throw new \Snscripts\Drip\Exceptions\SubscriberInfo('A subscribers email is required to remove a tag from them.');
        }

        $tagName = $this->Tag->name;
        if (empty($tagName)) {
            throw new \Snscripts\Drip\Exceptions\TagInfo('A Tag name is required to remove a tag from a subscriber.');
        }
    }

    /**
     * return the method type to use
     *
     * @return string $method
     */
    public function getMethodType()
    {
        return 'DELETE';
    }

    /**
     * return the constructed API endpoint
     *
     * @return string $endpointUrl
     */
    public function getEndpointUrl()
    {
        return ':accountId/subscribers/' . $this->Subscriber->email . '/tags/' . $this->Tag->name;
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
                \Snscripts\Result\Result::DELETED,
                'Subscriber (' . $this->Subscriber->email . ') has been untagged from "' . $this->Tag->name . '"'
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::ERROR,
            'There was an error removing the tag "' . $this->Tag->name . '" from the subscriber (' . $this->Subscriber->email . ')'
        );
    }
}
