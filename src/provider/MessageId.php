<?php

namespace alexeevdv\sms\provider;

final class MessageId implements \alexeevdv\Sms\Contract\MessageId
{
    /**
     * @var string
     */
    private $messageId;

    public function __construct($messageId)
    {
        $this->messageId = $messageId;
    }

    public function __toString()
    {
        return $this->messageId;
    }
}
