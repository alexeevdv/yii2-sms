<?php

namespace alexeevdv\sms;

use alexeevdv\sms\provider\BaseProvider;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;

/**
 * Class Sms
 * @package alexeevdv\sms
 */
class Sms extends Component
{
    /**
     * @var array
     */
    public $provider;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->provider === null) {
            throw new InvalidConfigException('`provider` is required.');
        }
        parent::init();
    }

    /**
     * @param string $number
     * @param string $text
     * @return bool
     */
    public function send($number, $text)
    {
        /** @var BaseProvider $provider */
        $provider = Instance::ensure($this->provider, BaseProvider::class);
        return $provider->send($number, $text);
    }
}
