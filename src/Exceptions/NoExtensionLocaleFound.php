<?php

namespace Xefi\Faker\Exceptions;

class NoExtensionLocaleFound extends \RuntimeException
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
