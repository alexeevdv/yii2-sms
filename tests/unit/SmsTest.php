<?php

namespace tests\unit;

use alexeevdv\Sms\Contract\Provider;
use alexeevdv\sms\provider\Exception;
use alexeevdv\sms\provider\MessageId;
use alexeevdv\sms\Sms;
use Codeception\Stub\Expected;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;
use yii\web\ErrorHandler;

/**
 * Class SmsTest
 * @package tests\unit
 */
final class SmsTest extends Unit
{
    public function testProviderIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new Sms([
            'errorHandler' => $this->make(ErrorHandler::class),
        ]);
    }

    public function testProviderIsInstanceOfProviderInterface()
    {
        $this->expectException(InvalidConfigException::class);
        new Sms([
            'errorHandler' => $this->make(ErrorHandler::class),
            'provider' => 'string',
        ]);
    }

    public function testSuccessfulInstantiation()
    {
        new Sms([
            'errorHandler' => $this->make(ErrorHandler::class),
            'provider' => $this->makeEmpty(Provider::class),
        ]);
    }

    public function testSuccessfulProviderSend()
    {
        $sms = new Sms([
            'errorHandler' => $this->make(ErrorHandler::class),
            'provider' => $this->makeEmpty(Provider::class, [
                'sendMessage' => new MessageId('123'),
            ]),
        ]);
        $this->assertTrue($sms->send('79876543210', 'Hello world!'));
    }

    public function testFailedProviderSend()
    {
        $sms = new Sms([
            'errorHandler' => $this->make(ErrorHandler::class, [
                'logException' => Expected::once(),
            ]),
            'provider' => $this->makeEmpty(Provider::class, [
                'sendMessage' => function () {
                    throw new Exception('Test');
                },
            ]),
        ]);
        $this->assertFalse($sms->send('79876543210', 'Hello world!'));
    }
}
