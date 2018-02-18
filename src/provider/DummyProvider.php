<?php

namespace alexeevdv\sms\provider;

/**
 * Class DummyProvider
 * @package alexeevdv\sms\provider
 */
class DummyProvider extends BaseProvider
{
    /**
     * @inheritdoc
     */
    public function send($number, $text)
    {
        return true;
    }
}
