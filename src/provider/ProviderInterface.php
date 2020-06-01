<?php

namespace alexeevdv\sms\provider;

/**
 * Interface ProviderInterface
 * @package alexeevdv\sms\provider
 */
interface ProviderInterface
{
    /**
     * @param string $number
     * @param string $text
     * @return bool
     */
    public function send($number, $text);
}
