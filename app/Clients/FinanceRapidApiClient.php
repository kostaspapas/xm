<?php

declare(strict_types=1);

namespace App\Clients;

use App\Clients\Curl\BaseCurlClient;
use App\Clients\Curl\Curl;
use stdClass;

/**
 * The client class which calls the API
 */
class FinanceRapidApiClient extends BaseCurlClient
{
    private const GET_HISTORICAL_DATA_URL = 'get-historical-data';

    public function __construct(Curl $curl, string $baseUrl) {
        parent::__construct($curl, $baseUrl);

        $this->defaultHeaders = [
            'X-RapidAPI-Key' => config('constants.x_rapid_api_key'),
            'X-RapidAPI-Host' => config('constants.x_rapid_api_host')
        ];
    }

    /**
     * Call the end point "get historical data"
     *
     * @param string $companySymbol
     * @return stdClass
     */
    public function getHistoricalData(string $companySymbol): stdClass
    {
        $url = self::GET_HISTORICAL_DATA_URL . "?symbol=" . $companySymbol;

        return $this->httpGet($url);
    }
}
