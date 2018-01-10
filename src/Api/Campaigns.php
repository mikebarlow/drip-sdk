<?php

namespace Snscripts\Drip\Api;

use Snscripts\Drip\Items\Campaign;
use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\Campaigns\ListAll;

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
}