<?php

namespace Snscripts\Drip\Api\Actions\Tags;

use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Items\Tag as TagItem;
use Snscripts\Drip\Api\Actions\AbstractAction;

class AddTag extends AbstractAction
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
            throw new \Snscripts\Drip\Exceptions\SubscriberInfo(
                'A subscribers email is required to apply a tag to them.'
            );
        }

        $tagName = $this->Tag->name;
        if (empty($tagName)) {
            throw new \Snscripts\Drip\Exceptions\TagInfo('A Tag name is required to apply a tag.');
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
        return [
            'json' => [
                'tags' => [[
                    'email' => $this->Subscriber->email,
                    'tag' => $this->Tag->name
                ]]
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
        if ($Response->getStatusCode() === 201) {
            return \Snscripts\Result\Result::success(
                \Snscripts\Result\Result::CREATED,
                'Subscriber (' . $this->Subscriber->email . ') has been tagged with "' . $this->Tag->name . '"'
            );
        }

        return \Snscripts\Result\Result::fail(
            \Snscripts\Result\Result::ERROR,
            'There was an error applying the tag "' . $this->Tag->name .
            '" to the subscriber (' . $this->Subscriber->email . ')'
        );
    }
}
