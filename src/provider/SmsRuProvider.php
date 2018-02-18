<?php

namespace alexeevdv\sms\provider;

use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;

/**
 * Class SmsRuProvider
 * @package alexeevdv\sms\provider
 */
class SmsRuProvider extends BaseProvider
{
    const STATUS_QUEUED = 100;

    /**
     * @var string
     */
    public $api_id;

    /**
     * @var array
     */
    public $httpClientConfig = [
        'class' => HttpClient::class,
        'baseUrl' => 'https://sms.ru/sms',
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
        if ($this->api_id === null) {
            throw new InvalidConfigException('`api_id` is required');
        }
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function send($number, $text)
    {
        $response = $this->apiCall('send', [
            'to' => $number,
            'msg' => $text,
        ]);
        return ArrayHelper::getValue($response, 'status_code') === static::STATUS_QUEUED;
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
            'json' => 1,
            'api_id' => $this->api_id,
        ]);

        $response = $client->get($method, $params)->send();
        return $response->data;
    }
}
