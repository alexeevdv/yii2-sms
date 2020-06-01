<?php

namespace alexeevdv\sms\Psr;

use Psr\Http\Client\ClientExceptionInterface;

final class HttpClientException extends \Exception implements ClientExceptionInterface
{
}
