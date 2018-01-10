<?php

namespace Snscripts\Drip\Api;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\Campaigns\Fetch;
use Snscripts\Drip\Api\Actions\Campaigns\Pause;
use Snscripts\Drip\Api\Actions\Campaigns\ListAll;
use Snscripts\Drip\Api\Actions\Campaigns\Activate;
use Snscripts\Drip\Api\Actions\Campaigns\Subscribers;

class Campaigns extends Endpoint
{
    /**
     * list all campaigns
     *
     * @param QueryFilter $QueryFilter|null
     * @return Campaigns $this
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
     * fetch a campaign
     *
     * @param Campaign $Campaign
     * @return Campaigns $this
     */
    public function fetch(Campaign $Campaign)
    {
        $this->loadedAction = new Fetch($Campaign);
        return $this;
    }

    /**
     * activate a campaign
     *
     * @param Campaign $Campaign
     * @return Campaigns $this
     */
    public function activate(Campaign $Campaign)
    {
        $this->loadedAction = new Activate($Campaign);
        return $this;
    }

    /**
     * pause a campaign
     *
     * @param Campaign $Campaign
     * @return Campaigns $this
     */
    public function pause(Campaign $Campaign)
    {
        $this->loadedAction = new Pause($Campaign);
        return $this;
    }

    /**
     * all the subscribers of a campaign
     *
     * @param Campaign $Campaign
     * @param QueryFilter $QueryFilter|null
     * @return Campaigns $this
     */
    public function subscribers(Campaign $Campaign, QueryFilter $QueryFilter = null)
    {
        if (is_null($QueryFilter)) {
            $QueryFilter = new QueryFilter;
        }

        $this->loadedAction = new Subscribers($Campaign, $QueryFilter);
        return $this;
    }
}
