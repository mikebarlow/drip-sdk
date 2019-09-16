<?php
namespace TutoraUK\Drip\Tests\Api;

use TutoraUK\Drip\Api\Filters\QueryFilter;
use TutoraUK\Drip\Api\Actions\Subscribers\ListAll;

class ListAllTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'TutoraUK\Drip\Api\Actions\Subscribers\ListAll',
            new ListAll(
                new QueryFilter(['page' => 5])
            )
        );
    }
}
