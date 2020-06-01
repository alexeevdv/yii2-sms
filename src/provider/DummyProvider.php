<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract\Provider;
use yii\base\BaseObject;

/**
 * Class DummyProvider
 * @package alexeevdv\sms\provider
 */
final class DummyProvider extends BaseObject implements Provider
{
    /**
     * @inheritdoc
     */
    public function sendMessage($number, $text)
    {
        return new MessageId('');
    }
}
