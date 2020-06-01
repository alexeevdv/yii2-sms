<?php

namespace alexeevdv\sms\provider;

final class PhoneNumber implements \alexeevdv\Sms\Contract\PhoneNumber
{
    /**
     * @var string
     */
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function __toString(): string
    {
        return $this->phoneNumber;
    }
}
