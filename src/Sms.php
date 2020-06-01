<?php

namespace alexeevdv\sms;

use alexeevdv\sms\provider\ProviderInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\di\Instance;

/**
 * Class Sms
 * @package alexeevdv\sms
 */
final class Sms extends Component
{
    /**
     * @var array
     */
    public $provider;

    /**
     * @var ProviderInterface
     */
    private $_provider;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->provider === null) {
            throw new InvalidConfigException('`provider` is required.');
        }

        $this->_provider = Instance::ensure($this->provider, ProviderInterface::class);

        parent::init();
    }

    /**
     * @param string $number
     * @param string $text
     * @return bool
     */
    public function send($number, $text)
    {
        return $this->_provider->send($number, $text);
    }
}
