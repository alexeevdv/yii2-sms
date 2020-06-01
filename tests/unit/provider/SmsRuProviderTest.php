<?php

namespace tests\unit\provider;

use alexeevdv\sms\provider\SmsRuProvider;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;

/**
 * Class SmsRuProviderTest
 * @package tests\unit\provider
 */
final class SmsRuProviderTest extends Unit
{
    public function testApiIdIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new SmsRuProvider();
    }

    public function testSuccessfulInstantiation()
    {
        new SmsRuProvider(['apiId' => 'secret']);
    }
}
