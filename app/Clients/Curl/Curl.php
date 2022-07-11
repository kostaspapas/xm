<?php

declare(strict_types=1);

namespace App\Clients\Curl;

use Ixudra\Curl\Facades\Curl as IxudraCurl;
use stdClass;
use Webmozart\Assert\Assert;

/**
 * Helpful class of curl methods
 */
class Curl
{
    public function get(string $url, array $headers): stdClass
    {
        return $this->buildCurl($url, $headers)->get();
    }

    private function buildCurl(string $url, array $headers)
    {
        $this->assertHeaders($headers);

        $builder = IxudraCurl::to($url)
            ->withHeaders($headers)
            ->returnResponseObject()
        ;

        return $builder->asJson(true);
    }

    private function assertHeaders(array $headers): void
    {
        Assert::allString($headers);
        Assert::allString(array_keys($headers));
    }
}
