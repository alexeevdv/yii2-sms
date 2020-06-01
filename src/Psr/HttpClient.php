<?php

namespace alexeevdv\sms\Psr;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class HttpClient extends Client implements ClientInterface
{
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            return $this->send($request, [
                RequestOptions::HTTP_ERRORS => false,
            ]);
        } catch (GuzzleException $e) {
            throw new HttpClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
