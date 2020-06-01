<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract\Provider;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\httpclient\Client as HttpClient;

/**
 * Class SmsRuProvider
 * @package alexeevdv\sms\provider
 */
final class SmsRuProvider extends BaseObject implements Provider
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
    public function sendMessage($number, $text)
    {
        $responseData = $this->apiCall('send', [
            'to' => $number,
            'msg' => $text,
        ]);


        $statusCode = ArrayHelper::getValue($responseData, 'status_code');
        if ($statusCode !== static::STATUS_QUEUED) {
            throw new Exception('Sms is not sent');
        }

        $messageId = ArrayHelper::getValue($responseData, 'sms.' . $number . '.sms_id', null);
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
            'json' => 1,
            'api_id' => $this->api_id,
        ]);

        $response = $client->get($method, $params)->send();
        return $response->data;
    }
}
