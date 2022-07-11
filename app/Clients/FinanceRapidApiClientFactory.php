<?php

declare(strict_types=1);

namespace App\Clients;

use App\Clients\Curl\Curl;

/**
 * The factory class which create the Finance client class
 */
class FinanceRapidApiClientFactory
{
    /** @var Curl Instance of Curl Class. It has curl helper methods */
    private $curl;

    /** @var string The base url of API which the client class will call*/
    private $baseUrl;

    public function __construct(Curl $curl, string $baseUrl)
    {
        $this->curl = $curl;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Create the client class
     *
     * @return FinanceRapidApiClient
     */
    public function createClient(): FinanceRapidApiClient
    {
        return new FinanceRapidApiClient($this->curl, $this->baseUrl);
    }
}
