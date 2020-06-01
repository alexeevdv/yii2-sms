<?php

namespace alexeevdv\sms;

use alexeevdv\Sms\Contract\Exception;
use alexeevdv\Sms\Contract\Provider;
use alexeevdv\sms\provider\PhoneNumber;
use yii\base\Component;
use yii\base\ErrorHandler;
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
     * @var ErrorHandler|array|string
     */
    public $errorHandler = 'errorHandler';

    /**
     * @var Provider
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

        $this->errorHandler = Instance::ensure($this->errorHandler, ErrorHandler::class);
        $this->_provider = Instance::ensure($this->provider, Provider::class);

        parent::init();
    }

    public function send(string $number, string $text): bool
    {
        try {
            $this->_provider->sendMessage(new PhoneNumber($number), $text);
            return true;
        } catch (Exception $e) {
            $this->errorHandler->logException($e);
            return false;
        }
    }
}
