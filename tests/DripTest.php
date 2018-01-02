<?php
namespace Snscripts\Drip\Tests;

use Snscripts\Drip\Drip;
use GuzzleHttp\ClientInterface;
use Snscripts\Drip\Auth\AbstractAuth;

class DripTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateInstance()
    {
        $this->assertInstanceOf(
            'Snscripts\Drip\Drip',
            new Drip(
                $this->getMock(ClientInterface::class)
            )
        );

        $this->assertInstanceOf(
            'Snscripts\Drip\Drip',
            new Drip(
                $this->getMock(ClientInterface::class),
                $this->getMock(AbstractAuth::class, [], ['token' => 'qwe'])
            )
        );
    }

    public function testDefaultsValuesAreAccessible()
    {
        $Drip = new Drip(
            $this->getMock(ClientInterface::class)
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
