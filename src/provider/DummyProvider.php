<?php

namespace alexeevdv\sms\provider;

use yii\base\BaseObject;

/**
 * Class DummyProvider
 * @package alexeevdv\sms\provider
 */
final class DummyProvider extends BaseObject implements ProviderInterface
{
    /**
     * @inheritdoc
     */
    public function send($number, $text)
    {
        return true;
    }
}
