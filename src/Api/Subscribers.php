<?php

namespace Snscripts\Drip\Api;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Items\Subscriber;
use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\Subscribers\Fetch;
use Snscripts\Drip\Api\Actions\Subscribers\Delete;
use Snscripts\Drip\Api\Actions\Subscribers\ListAll;
use Snscripts\Drip\Api\Actions\Subscribers\Subscribe;
use Snscripts\Drip\Api\Actions\Subscribers\Unsubscribe;
use Snscripts\Drip\Api\Actions\Subscribers\CreateUpdate;

class Subscribers extends Endpoint
{
    /**
     * list all subscribers
     *
     * @param QueryFilter $QueryFilter|null
     * @return Subscribers $this
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
     * create / update subscriber
     *
     * @param Subscriber $Subscriber
     * @return Subscribers $this
     */
    public function createUpdate(Subscriber $Subscriber)
    {
        $this->loadedAction = new CreateUpdate($Subscriber);
        return $this;
    }

    /**
     * Delete a subscriber
     *
     * @param Subscriber $Subscriber
     * @return Subscribers $this
     */
    public function delete(Subscriber $Subscriber)
    {
        $this->loadedAction = new Delete($Subscriber);
        return $this;
    }

    /**
     * fetch a subscriber
     *
     * @param Subscriber $Subscriber
     * @return Subscribers $this
     */
    public function fetch(Subscriber $Subscriber)
    {
        $this->loadedAction = new Fetch($Subscriber);
        return $this;
    }

    /**
     * unsubscribe a subscriber
     *
     * @param Subscriber $Subscriber
     * @param Campaign $Campaign|null
     * @return Subscribers $this
     */
    public function unsubscribe(Subscriber $Subscriber, Campaign $Campaign = null)
    {
        $this->loadedAction = new Unsubscribe($Subscriber, $Campaign);
        return $this;
    }

    /**
     * subscribe a subscriber
     *
     * @param Subscriber $Subscriber
     * @param Campaign $Campaign
     * @return Subscribers $this
     */
    public function subscribe(Subscriber $Subscriber, Campaign $Campaign)
    {
        $this->loadedAction = new Subscribe($Subscriber, $Campaign);
        return $this;
    }
}
