<?php

declare(strict_types=1);

namespace App\Services;

/**
 * the Parent service class
 */
class Service
{
    /**
     *  Check if http code is a successful one
     * @param int $code
     * @return bool Returns true is the http code is between 200 and 300
     */
    protected function isHttpStatusCodeSuccessful(int $code): bool
    {
        return $code >= 200 && $code < 300;
    }

}
