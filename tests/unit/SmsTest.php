<?php

namespace tests\unit;

use alexeevdv\sms\provider\DummyProvider;
use alexeevdv\sms\Sms;
use yii\base\InvalidConfigException;

/**
 * Class SmsTest
 * @package tests\unit
 */
class SmsTest extends \Codeception\Test\Unit
{
    /**
     * @var \tests\UnitTester
     */
    public $tester;

    /**
     * @test
     */
    public function init()
    {
        // Check that provider is required
        $this->tester->expectException(InvalidConfigException::class, function () {
            new Sms;
        });

        // Check that provider is instance of BaseProvider
        $this->tester->expectException(InvalidConfigException::class, function () {
            new Sms([
                'provider' => 'String',
            ]);
        });

        new Sms([
            'provider' => DummyProvider::class,
        ]);
    }

    /**
     * @test
     */
    public function send()
    {
        $sms = new Sms([
            'provider' => DummyProvider::class,
        ]);

        $this->tester->assertTrue($sms->send('79876543210', 'Hello world!'));
    }
}
