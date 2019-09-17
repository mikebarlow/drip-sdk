<?php

namespace TutoraUK\Drip\Api;

use TutoraUK\Drip\Drip;
use Snscripts\GetSet\GetSet;

class Endpoint
{
    use GetSet;

    /**
     * Constructor - store the Drip object
     *
     * @param Drip $Drip
     */
    public function __construct(Drip $Drip)
    {
        $this->Drip = $Drip;
    }

    /**
     * run the query
     *
     * @return TutoraUK\Result|Result
     */
    public function run()
    {
        if (! is_object($this->loadedAction)) {
            throw new \TutoraUK\Drip\Exceptions\NoActionLoaded('No action was loaded for ' . get_class($this));
        }

        $Query = $this->Drip->http;

        try {
            $Response = $Query->request(
                $this->loadedAction->getMethodType(),
                $this->buildUrl(
                    $this->Drip,
                    $this->loadedAction->getEndpointUrl()
                ),
                $this->buildOptions(
                    $this->Drip,
                    $this->loadedAction->getRequestOptions()
                )
            );
        } catch (\Exception $e) {
            // throw our own exception here
            throw new \TutoraUK\Drip\Exceptions\QueryFailed(
                'Query (' . get_class($this) . '::' . get_class($this->loadedAction) .
                ') failed, error given was ' . $e->getMessage()
            );
        }

        return $this->loadedAction->processResponse($Response);
    }

    /**
     * build the options array - merge defaults with auth tokens and action
     *
     * @param Drip $Drip
     * @param array $options Options defined by the action
     * @return array
     */
    public function buildOptions(Drip $Drip, $options = [])
    {
        return array_merge_recursive(
            [
                'headers' => [
                    'User-Agent' => $Drip->userAgent,
                    'Content-Type' => 'application/vnd.api+json',
                    'Accept' => 'application/vnd.api+json'
                ]
            ],
            $Drip->auth->build(),
            $options
        );
    }

    /**
     * Given the Drip object and the endpoint url
     * construct the full url
     *
     * @param Drip $Drip
     * @param string $endpointUrl
     * @return string
     */
    public function buildUrl(Drip $Drip, $endpointUrl)
    {
        if (empty($Drip->accountId)) {
            throw new \TutoraUK\Drip\Exceptions\EmptyAccountId('Your account id must be filled in');
        }

        $endpointUrl = ltrim(
            str_replace(':accountId', $Drip->accountId, $endpointUrl),
            '/'
        );

        $url = rtrim(
            $Drip->apiUrl,
            '/'
        );

        return $url . '/' . $endpointUrl;
    }
}
