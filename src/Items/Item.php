<?php

namespace TutoraUK\Drip\Items;

use TutoraUK\GetSet\GetSet;

class Item
{
    use GetSet;

    /**
     * Constructor, setup new object
     *
     * @param array
     */
    public function __construct($data)
    {
        $this->setAllData($data);
    }
}
