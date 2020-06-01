<?php

namespace tests\unit\provider;

use alexeevdv\sms\provider\SmscRuProvider;
use Codeception\Test\Unit;
use yii\base\InvalidConfigException;

/**
 * Class SmscRuProviderTest
 * @package tests\unit\provider
 */
final class SmscRuProviderTest extends Unit
{
    public function testLoginIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new SmscRuProvider(['psw' => 'secret']);
    }

    public function testPasswordIsRequired()
    {
        $this->expectException(InvalidConfigException::class);
        new SmscRuProvider(['login' => 'user']);
    }

    public function testSuccessfulInstantiation()
    {
        new SmscRuProvider([
            'login' => 'user',
            'psw' => 'secret',
        ]);
    }
}
