<?php

namespace alexeevdv\sms\provider;

use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;

/**
 * Class SmscRuProvider
 * @package alexeevdv\sms\provider
 */
class SmscRuProvider extends BaseProvider
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
     * @inheritdoc
     */
    public function send($number, $text)
    {
        $response = $this->apiCall('send.php', [
            'phones' => $number,
            'mes' => $text,
        ]);
        return ArrayHelper::getValue($response, 'id', null) !== null;
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
