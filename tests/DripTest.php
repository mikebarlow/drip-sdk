<?php
namespace TutoraUK\Drip\Tests;

use TutoraUK\Drip\Drip;
use GuzzleHttp\ClientInterface;
use TutoraUK\Drip\Auth\AbstractAuth;

class DripTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'TutoraUK\Drip\Drip',
            new Drip(
                $this->createMock(ClientInterface::class)
            )
        );

        $this->assertInstanceOf(
            'TutoraUK\Drip\Drip',
            new Drip(
                $this->createMock(ClientInterface::class),
                $this->createMock(AbstractAuth::class, [], ['token' => 'qwe'])
            )
        );
    }

    public function testDefaultsValuesAreAccessible()
    {
        $Drip = new Drip(
            $this->createMock(ClientInterface::class)
        );

        $this->assertSame(
            'https://api.getdrip.com/v2',
            $Drip->apiUrl
        );

        $this->assertSame(
            'Your App Name (www.example.com)',
            $Drip->userAgent
        );
    }
}
