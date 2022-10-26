<?php
namespace TutoraUK\Drip\Tests\Api;

use PHPUnit\Framework\TestCase;
use TutoraUK\Drip\Api\Filters\QueryFilter;
use TutoraUK\Drip\Api\Actions\Subscribers\ListAll;

class ListAllTest extends TestCase
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
