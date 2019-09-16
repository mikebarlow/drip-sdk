<?php

namespace TutoraUK\Drip\Api\Filters;

use TutoraUK\GetSet\GetSet;

class QueryFilter
{
    use GetSet;

    /**
     * Constructor, setup new object
     *
     * @param array
     */
    public function __construct($data = [])
    {
        $this->setAllData($data);
    }

    /**
     * Format QueryFilter data into a query array for guzzle
     *
     * @return array
     */
    public function toQueryString()
    {
        return [
            'query' => $this->toArray()
        ];
    }
}
