<?php

namespace alexeevdv\sms\provider;

use Throwable;

final class Exception extends \Exception implements \alexeevdv\Sms\Contract\Exception
{
    public function __construct($message = '', Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
