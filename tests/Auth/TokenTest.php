<?php
namespace TutoraUK\Drip\Tests\Auth;

use PHPUnit\Framework\TestCase;
use TutoraUK\Drip\Auth\Token;
use TutoraUK\Drip\Exceptions\EmptyToken;

class TokenTest extends TestCase
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
        $this->expectException(EmptyToken::class);

        $Auth = new Token('');
    }
}
