# Campaigns

Before running through the following documentation, please make sure you have read the Getting Started page within the docs.

## List all campaigns

    // Setup the object for the campaigns endpoints
    $Api = new \TutoraUK\Drip\Api\Campaigns(
        $Drip
    );

    // get all campaigns in your account
    $Result = $Api->listAll()
        ->run();

    // Successfully found?
    var_dump($Result->isSuccess());

    // Actual results - Cartalyst\Collection
    $Campaigns = $Results->getExtras('campaigns');

    // Each item in collection is an instance of
    // TutoraUK\Drip\Items\Campaign
    foreach ($Campaigns as $Campaign) {
        echo $Campaign->id . '<br>';
    }

## Fetch Campaign

To fetch a campaign the Drip Campaign ID will be need

    $Api = new \TutoraUK\Drip\Api\Campaigns(
        $Drip
    );

    // Create a new campaign object
    $Campaign = new \TutoraUK\Drip\Items\Campaign([
        'id' => 123
    ]);

    // run the endpoint
    $Result = $Api->fetch($Campaign)
        ->run();

    $Campaign = $Result->getExtras('campaign');

## Activate Campaign

To activate a campaign the Drip Campaign ID will be need

    $Api = new \TutoraUK\Drip\Api\Campaigns(
        $Drip
    );

    // Create a new campaign object
    $Campaign = new \TutoraUK\Drip\Items\Campaign([
        'id' => 123
    ]);

    // run the endpoint
    $Result = $Api->activate($Campaign)
        ->run();

    var_dump($Result->isSuccess());

## Pause Campaign

To pause a campaign the Drip Campaign ID will be need

    $Api = new \TutoraUK\Drip\Api\Campaigns(
        $Drip
    );

    // Create a new campaign object
    $Campaign = new \TutoraUK\Drip\Items\Campaign([
        'id' => 123
    ]);

    // run the endpoint
    $Result = $Api->paused($Campaign)
        ->run();

    var_dump($Result->isSuccess());

## List everyone subscribed to a campaign

To list all the subscribers to a campaign, the Drip Campaign ID will be needed. QueryFilters can be used with this subscribers endpoint.


    // Setup the object for the campaigns endpoints
    $Api = new \TutoraUK\Drip\Api\Campaigns(
        $Drip
    );

    // Create a new campaign object
    $Campaign = new \TutoraUK\Drip\Items\Campaign([
        'id' => 123
    ]);

    // get all campaigns in your account
    $Result = $Api->subscribers($Campaign)
        ->run();

    // subscribers() can accept a second parameter containing QueryFilters
    $QueryFilter = new \TutoraUK\Drip\Utils\QueryFilter([
        'status' => 'active',
        'page' => 5
    ]);
    $Result = $Api->subscribers($Campaign, $QueryFilter)
        ->run();

    // Successfully found?
    var_dump($Result->isSuccess());

    // Actual results - Cartalyst\Collection
    $Subscribers = $Results->getExtras('subscribers');

    // Each item in collection is an instance of
    // TutoraUK\Drip\Items\Subscriber
    foreach ($Subscribers as $Subscriber) {
        echo $Subscriber->id . '<br>';
    }

