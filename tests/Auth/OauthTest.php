<?php
namespace TutoraUK\Drip\Tests\Auth;

use PHPUnit\Framework\TestCase;
use TutoraUK\Drip\Auth\Oauth;
use TutoraUK\Drip\Exceptions\EmptyToken;

class OauthTest extends TestCase
{
    public function testBuildFormatsCorrectly()
    {
        $Auth = new Oauth('my-oauth-token');

        $this->assertSame(
            [
                'headers' => [
                    'Authorization' => 'Bearer my-oauth-token'
                ]
            ],
            $Auth->build()
        );
    }

    public function testExceptionIsThrownWhenTokenIsEmpty()
    {
        $this->expectException(EmptyToken::class);

        $Auth = new Oauth('');
    }
}
