<?php

namespace alexeevdv\sms\provider;

use yii\base\BaseObject;

/**
 * Class BaseProvider
 * @package alexeevdv\sms\provider
 */
abstract class BaseProvider extends BaseObject
{
    /**
     * @param string $number
     * @param string $text
     * @return bool
     */
    abstract public function send($number, $text);
}
