# Events

Before running through the following documentation, please make sure you have read the Getting Started page within the docs.

## Record an event

Record an event against a subscriber in drip (email or drip id is required).

    $Api = new \TutoraUK\Drip\Api\Events(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \TutoraUK\Drip\Items\Subscriber([
        'email' => 'test@test.com', // email or
        'user_id' => '123' // drip id
    ]);

    // Create a new Event object
    $Event = new \TutoraUK\Drip\Items\Event([
        'action' => 'Event action'
    ]);

    // run with just a subscriber object to unsubscribe from all
    $Result = $Api->record($Subscriber, $Event)
        ->run();

## List all custom event actions used

This endpoint lists out aggregated list of all custom events used across all subscribers. QueryFilters can be used for paging.

    $Api = new \TutoraUK\Drip\Api\Events(
        $Drip
    );

    // get all events in your account
    $Result = $Api->listAll()
        ->run();

    // listAll() can accept a parameter containing QueryFilters
    $QueryFilter = new \TutoraUK\Drip\Utils\QueryFilter([
        'per_page' => 50,
        'page' => 2
    ]);
    $Result = $Api->listAll($QueryFilter)
        ->run();

    $Events = $Result->getExtras('events');

    foreach ($Events as $Event) {
        echo $Event->action . '<br>';
    }
