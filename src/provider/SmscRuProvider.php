<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract\Provider;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;

/**
 * Class SmscRuProvider
 * @package alexeevdv\sms\provider
 */
final class SmscRuProvider extends BaseObject implements Provider
{
    const FORMAT_JSON = 3;

    /**
     * @var string
     */
    public $login;

    /**
     * @var string
     */
    public $psw;

    /**
     * @var array
     */
    public $httpClientConfig = [
        'class' => HttpClient::class,
        'baseUrl' => 'https://smsc.ru/sys',
        'responseConfig' => [
            'format' => HttpClient::FORMAT_JSON
        ],
    ];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->login === null) {
            throw new InvalidConfigException('`login` is required');
        }
        if ($this->psw === null) {
            throw new InvalidConfigException('`psw` is required');
        }
        parent::init();
    }

    /**
     * @throws Exception
     *
     * @inheritdoc
     */
    public function sendMessage($number, $text)
    {
        $response = $this->apiCall('send.php', [
            'phones' => $number,
            'mes' => $text,
        ]);

        $messageId = ArrayHelper::getValue($response, 'id', null);
        if ($messageId === null) {
            throw new Exception('Message ID is null');
        }

        return new MessageId($messageId);
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     */
    public function apiCall($method, array $params = [])
    {
        /** @var HttpClient $client */
        $client = Instance::ensure($this->httpClientConfig, HttpClient::class);

        // Require json response
        $params = ArrayHelper::merge($params, [
            'fmt' => static::FORMAT_JSON,
            'login' => $this->login,
            'psw' => $this->psw,
        ]);

        $response = $client->get($method, $params)->send();
        return $response->data;
    }
}
