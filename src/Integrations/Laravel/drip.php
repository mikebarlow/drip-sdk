<?php

return [
    // Your drip api token
    'apiToken' => env('DRIP_API_TOKEN'),

    // Your drip account id
    'accountId' => env('DRIP_ACCOUNT_ID'),

    // Drip authorisation type
    // @see https://www.getdrip.com/docs/rest-api#authentication
    // token or oauth
    'authType' => 'token'
];
