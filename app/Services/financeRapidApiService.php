<?php

declare(strict_types=1);

namespace App\Services;

use App\Clients\FinanceRapidApiClientFactory;
use App\DataExtractors\HistoricalQuotesDataExtractor;
use App\Filters\FinanceDataFilter;
use App\Formatters\FinanceFormatter;

/**
 * You can use this service class to get the finance data
 */
class financeRapidApiService extends Service
{
    private $financeRapidApiClientFactory;
    private $financeRapidApiClient;

    public function __construct(
        FinanceRapidApiClientFactory $financeRapidApiClientFactory
    ) {
        $this->financeRapidApiClientFactory = $financeRapidApiClientFactory;
        $this->financeRapidApiClient = $this->financeRapidApiClientFactory->createClient();
    }

    /**
     * Get historical data
     *
     * @param string $companySymbol The company symbol (i.e. AAIT)
     * @param string $startDate The start date (i.e 07/01/2022 m/d/Y)
     * @param string $endDate The end date (i.e 07/01/2022 m/d/Y)
     * @return array The historical data ina array
     */
    public function getHistoricalData(
        string $companySymbol,
        string $startDate,
        string $endDate): array
    {
        $response = $this->financeRapidApiClient->getHistoricalData($companySymbol);

        if (!$this->isHttpStatusCodeSuccessful($response->status)) {
            return [];
        }

        if (isset($response->content) && count($response->content['prices']) === 0) {
            return [];
        }

        $historicalQuotes = $response->content['prices'];

        $financialFilter = new FinanceDataFilter($historicalQuotes);
        $filteredHistoricalQuotes = $financialFilter->getData($startDate, $endDate);

        $dataExtractor = new HistoricalQuotesDataExtractor(
            new FinanceFormatter(),
            $filteredHistoricalQuotes
        );

        $results = [
            'historical_quotes' => $dataExtractor->getHistoricalQuotes(),
            'historical_dates' => $dataExtractor->getHistoricalDates(),
            'historical_open_prices' => $dataExtractor->getHistoricalOpenPrices(),
            'historical_close_prices' => $dataExtractor->getHistoricalClosePrices()
        ];

        return $results;
    }
}
