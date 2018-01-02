<?php
namespace Snscripts\Drip\Tests\Auth;

use Snscripts\Drip\Auth\Token;
use Snscripts\Drip\Exceptions\EmptyToken;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildFormatsCorrectly()
    {
        $Auth = new Token('my-token');

        $this->assertSame(
            ['auth' => ['my-token', '']],
            $Auth->build()
        );
    }

    public function testExceptionIsThrownWhenTokenIsEmpty()
    {
        $this->setExpectedException(EmptyToken::class);

        $Auth = new Token('');
    }
}
