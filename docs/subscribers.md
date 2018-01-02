# Subscribers

Before running through the following documentation, please make sure you have read the Getting Started page within the docs.

## Retrieving all subscribers

    // Setup the object for the subscribers endpoints
    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // get all subscribers in your account
    $Result = $Api->listAll()
        ->run();

    // Successfully found?
    var_dump($Result->isSuccess());

    // Actual results - Cartalyst\Collection
    $Subscribers = $Results->getExtras('subscribers');

    // Each item in collection is an instance of
    // Snscripts\Drip\Items\Subscriber
    foreach ($Subscribers as $Subscriber) {
        echo $Subscriber->id . '<br>';
    }

## Create / Update Subscriber

View the Drip REST documentation to view the full list of available parameters for your subscriber object.

    // Setup the object for the subscribers endpoints
    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \Snscripts\Drip\Items\Subscriber([
        'email' => 'test@test.com',
        'user_id' => '123',
        'tags' => [
            'test',
            'tag'
        ]
    ]);

    // run the create / Update endpoint
    $Result = $Api->createUpdate($Subscriber)
        ->run();

    $Subscriber = $Result->getExtras('subscriber');

    $dripID = $Subscriber->id;

As per Drip REST documentation, the create / update endpoints are the same, to update a subscriber simply pass the `email` or `id` field of an existing Drip subscriber into the `Subscriber` object above before running the API endpoint.

## Delete Subscriber

To delete a subscriber either their email address or Drip id will be needed.

    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \Snscripts\Drip\Items\Subscriber([
        'email' => 'test@test.com', // email or
        'id' => '123' // drip id
    ]);

    // run the endpoint
    $Result = $Api->delete($Subscriber)
        ->run();

## Fetch Subscriber

To fetch a subscriber either their email address or Drip id will be needed.

    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \Snscripts\Drip\Items\Subscriber([
        'email' => 'test@test.com', // email or
        'id' => '123' // drip id
    ]);

    // run the endpoint
    $Result = $Api->fetch($Subscriber)
        ->run();

    $Subscriber = $Result->getExtras('subscriber');

## Unsubscribe from one or all campaigns

You are able to unsubscribe a user from all campaigns in one call or just a single campaign. If the second parameter, a Campaign object is omitted, the subscriber will be unsubscribed from all campaigns.

    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \Snscripts\Drip\Items\Subscriber([
        'email' => 'test@test.com', // email or
        'id' => '123' // drip id
    ]);

    // run with just a subscriber object to unsubscribe from all
    $Result = $Api->unsubscribe($Subscriber)
        ->run();

    // create a new campaign object and pass as second parameter to
    // remove from individual campaign
    $Campaign = new \Snscripts\Drip\Items\Campaign([
        'id' => 123
    ]);

    // Run with both to remove given subscriber from given campaign
    $Result = $Api->unsubscribe($Subscriber, $Campaign)
        ->run();

## Subscribe to a campaign

Part of the "campaigns" section of Drip docs however for consistency, subscribing a user to a campaign has been bundled with the rest of the subscriber endpoints.

    $Api = new \Snscripts\Drip\Api\Subscribers(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \Snscripts\Drip\Items\Subscriber([
        'email' => 'test@test.com', // email or
        'id' => '123', // drip id
        'double_optin' => false,
        'reactive_if_removed' => true
    ]);

    // create a new campaign object and pass as second parameter to
    // remove from individual campaign
    $Campaign = new \Snscripts\Drip\Items\Campaign([
        'id' => 123
    ]);

    // Run with both to remove given subscriber from given campaign
    $Result = $Api->subscribe($Subscriber, $Campaign)
        ->run();
