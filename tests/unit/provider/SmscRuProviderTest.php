<?php

namespace tests\unit\provider;

use alexeevdv\sms\provider\SmscRuProvider;
use yii\base\InvalidConfigException;

/**
 * Class SmscRuProviderTest
 * @package tests\unit\provider
 */
class SmscRuProviderTest extends \Codeception\Test\Unit
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
        // login and psw should be required
        $this->tester->expectException(InvalidConfigException::class, function () {
            new SmscRuProvider;
        });

        $this->tester->expectException(InvalidConfigException::class, function () {
            new SmscRuProvider(['login' => 'login']);
        });

        $this->tester->expectException(InvalidConfigException::class, function () {
            new SmscRuProvider(['psw' => 'psw']);
        });

        new SmscRuProvider([
            'login' => 'login',
            'psw' => 'psw'
        ]);
    }
}
