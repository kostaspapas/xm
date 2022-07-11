<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

/**
 * Class HttpClientException.
 */
final class HttpClientException extends RuntimeException
{
    private $context;

    public function __construct(string $message, array $context = [])
    {
        parent::__construct($message);
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
