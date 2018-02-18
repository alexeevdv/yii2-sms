<?php

namespace tests\unit\provider;

use alexeevdv\sms\provider\SmsRuProvider;
use yii\base\InvalidConfigException;

/**
 * Class SmsRuProviderTest
 * @package tests\unit\provider
 */
class SmsRuProviderTest extends \Codeception\Test\Unit
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
        // api_id should be required
        $this->tester->expectException(InvalidConfigException::class, function () {
            new SmsRuProvider;
        });

        new SmsRuProvider([
            'api_id' => '1234567890',
        ]);
    }
}
