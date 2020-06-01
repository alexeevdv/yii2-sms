<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract;
use yii\base\BaseObject;

/**
 * Class DummyProvider
 * @package alexeevdv\sms\provider
 */
final class DummyProvider extends BaseObject implements Contract\Provider
{
    /**
     * @inheritdoc
     */
    public function sendMessage(Contract\PhoneNumber $phoneNumber, string $text): Contract\MessageId
    {
        return new MessageId('');
    }
}
