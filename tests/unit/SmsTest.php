<?php

namespace tests\unit;

use alexeevdv\sms\provider\ProviderInterface;
use alexeevdv\sms\Sms;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;

/**
 * Class SmsTest
 * @package tests\unit
 */
final class SmsTest extends Unit
{
    public function testProviderIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new Sms();
    }

    public function testProviderIsInstanceOfProviderInterface()
    {
        $this->expectException(InvalidConfigException::class);
        new Sms(['provider' => 'string']);
    }

    public function testSuccessfulInstantiation()
    {
        new Sms([
            'provider' => $this->makeEmpty(ProviderInterface::class),
        ]);
    }

    public function testSuccessfulProviderSend()
    {
        $sms = new Sms([
            'provider' => $this->makeEmpty(ProviderInterface::class, [
                'send' => true,
            ]),
        ]);
        $this->assertTrue($sms->send('79876543210', 'Hello world!'));
    }

    public function testFailedProviderSend()
    {
        $sms = new Sms([
            'provider' => $this->makeEmpty(ProviderInterface::class, [
                'send' => false,
            ]),
        ]);
        $this->assertFalse($sms->send('79876543210', 'Hello world!'));
    }
}
