<?php
namespace Snscripts\Drip\Tests\Api;

use Snscripts\Drip\Api\Filters\QueryFilter;
use Snscripts\Drip\Api\Actions\Subscribers\ListAll;

class ListAllTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'Snscripts\Drip\Api\Actions\Subscribers\ListAll',
            new ListAll(
                new QueryFilter(['page' => 5])
            )
        );
    }
}
