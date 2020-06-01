<?php

namespace alexeevdv\sms\provider;

use alexeevdv\Sms\Contract;

final class MessageId implements Contract\MessageId
{
    /**
     * @var string
     */
    private $messageId;

    public function __construct(string $messageId)
    {
        $this->messageId = $messageId;
    }

    public function __toString(): string
    {
        return $this->messageId;
    }
}
