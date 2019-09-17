# Getting Started

## Setup

To get started you first need to define the Drip class and pass in the Guzzle dependency.

    $Drip = new \TutoraUK\Drip\Drip(
        new \GuzzleHttp\Client
    );

Next you will need to create an authorization class using either token based auth or oauth based, this then needs setting into the Drip object instantiated above. For information on how to get these tokens view the Drip documentation [here](https://www.getdrip.com/docs/rest-api#authentication).

    // Token Based
    $Drip->setAuth(
        new \TutoraUK\Drip\Auth\Token('API-TOKEN')
    );

    // Oauth
    $Drip->setAuth(
        new \TutoraUK\Drip\Auth\OAuth('OAUTH-TOKEN')
    );

Set your Drip account ID by called

    $Drip->setAccountId('DRIP-ID');


## Results

The `run` method will always return an instance of `Snscripts\Result\Result`. The values attached to the object returned vary depending on the API end point called. For full documentation regarding this object see the [docs here](https://github.com/mikebarlow/result/blob/master/README.md).

## Query Filters

Some `GET` endpoints can be filtered on, use an instance of the `QueryFilter` object, defining your parameters in the construct and pass this into your API method.

    $QueryFilter = new \TutoraUK\Drip\Utils\QueryFilter([
        'status' => 'active',
        'tags' => 'tag1, tag2'
    ]);

    $Api = new \TutoraUK\Drip\Api\Subscribers(
        $Drip
    );

    // get all subscribers in your account
    $Subscribers = $Api->listAll($QueryFilter)
        ->run();

Available filters and parameters can be found within the [Drip API documentation](https://www.getdrip.com/docs/rest-api)
