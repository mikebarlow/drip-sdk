# Tags

Before running through the following documentation, please make sure you have read the Getting Started page within the docs.

## List all tags

    $Api = new \TutoraUK\Drip\Api\Tags(
        $Drip
    );

    // get all tags in your account
    $Result = $Api->listAll()
        ->run();

    $Tags = $Result->getExtras('tags');

    foreach ($Tags as $Tag) {
        echo $Tag->name . '<br>';
    }

## Tag a Subscriber

    $Api = new \TutoraUK\Drip\Api\Tags(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \TutoraUK\Drip\Items\Subscriber([
        'email' => 'test@test.com',
        'user_id' => '123'
    ]);

    // Create a tag object
    $Tag = new \TutoraUK\Drip\Items\Tag([
        'name' => 'customer'
    ]);

    $Result = $Api->addTag($Subscriber, $Tag)
        ->run();

## Untag a Subscriber

    $Api = new \TutoraUK\Drip\Api\Tags(
        $Drip
    );

    // Create a new subscriber object
    $Subscriber = new \TutoraUK\Drip\Items\Subscriber([
        'email' => 'test@test.com',
        'user_id' => '123'
    ]);

    // Create a tag object
    $Tag = new \TutoraUK\Drip\Items\Tag([
        'name' => 'customer'
    ]);

    $Result = $Api->removeTag($Subscriber, $Tag)
        ->run();

