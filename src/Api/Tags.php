<?php

namespace Snscripts\Drip\Api;

use Snscripts\Drip\Items\Tag;
use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Api\Actions\Tags\AddTag;
use Snscripts\Drip\Api\Actions\Tags\ListAll;
use Snscripts\Drip\Api\Actions\Tags\RemoveTag;

class Tags extends Endpoint
{
    /**
     * list all tags
     *
     * @return Tags $this
     */
    public function listAll()
    {
        $this->loadedAction = new ListAll;
        return $this;
    }

    /**
     * apply a tag to a subscriber
     *
     * @param Subscriber $Subscriber
     * @param Tag $Tag
     * @return Tags $this
     */
    public function addTag(Subscriber $Subscriber, Tag $Tag)
    {
        $this->loadedAction = new AddTag($Subscriber, $Tag);
        return $this;
    }

    /**
     * remove a tag from a subscriber
     *
     * @param Subscriber $Subscriber
     * @param Tag $Tag
     * @return Tags $this
     */
    public function removeTag(Subscriber $Subscriber, Tag $Tag)
    {
        $this->loadedAction = new RemoveTag($Subscriber, $Tag);
        return $this;
    }
}
