<?php
namespace TutoraUK\Drip\Tests\Auth;

use TutoraUK\Drip\Auth\Oauth;
use TutoraUK\Drip\Exceptions\EmptyToken;

class OauthTest extends \PHPUnit_Framework_TestCase
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
        $this->setExpectedException(EmptyToken::class);

        $Auth = new Oauth('');
    }
}
