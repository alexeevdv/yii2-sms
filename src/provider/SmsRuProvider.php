<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract;
use alexeevdv\sms\Psr\HttpClient;
use alexeevdv\sms\Psr\RequestFactory;
use alexeevdv\Sms\SmsRu\PhoneNumber;
use alexeevdv\Sms\SmsRu\Provider;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;

/**
 * Class SmsRuProvider
 * @package alexeevdv\sms\provider
 */
final class SmsRuProvider extends BaseObject implements Contract\Provider
{
    /**
     * @var string
     */
    public $apiId;

    /**
     * @var ClientInterface|array|string
     */
    public $httpClient = HttpClient::class;

    /**
     * @var RequestFactoryInterface|array|string
     */
    public $requestFactory = RequestFactory::class;

    /**
     * @var SmsRuProvider
     */
    private $_provider;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->apiId === null) {
            throw new InvalidConfigException('`apiId` is required');
        }

        $this->httpClient = Instance::ensure($this->httpClient, ClientInterface::class);
        $this->requestFactory = Instance::ensure($this->requestFactory, RequestFactoryInterface::class);

        $this->_provider = new Provider($this->apiId, $this->httpClient, $this->requestFactory);

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function sendMessage(Contract\PhoneNumber $number, string $text): Contract\MessageId
    {
        return $this->_provider->sendMessage(new PhoneNumber((string) $number), $text);
    }
}
