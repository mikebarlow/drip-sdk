<?php

namespace TutoraUK\Drip\Api;

use TutoraUK\Drip\Items\Event;
use TutoraUK\Drip\Items\Subscriber;
use TutoraUK\Drip\Api\Filters\QueryFilter;
use TutoraUK\Drip\Api\Actions\Events\Record;
use TutoraUK\Drip\Api\Actions\Events\ListAll;

class Events extends Endpoint
{
    /**
     * list all events
     *
     * @param QueryFilter $QueryFilter|null
     * @return Events $this
     */
    public function listAll(QueryFilter $QueryFilter = null)
    {
        if (is_null($QueryFilter)) {
            $QueryFilter = new QueryFilter;
        }

        $this->loadedAction = new ListAll($QueryFilter);
        return $this;
    }

    /**
     * Record an event on a subscriber
     *
     * @param Subscriber $Subscriber
     * @param Event $Event
     * @return Events $this
     */
    public function record(Subscriber $Subscriber, Event $Event)
    {
        $this->loadedAction = new Record($Subscriber, $Event);
        return $this;
    }
}
