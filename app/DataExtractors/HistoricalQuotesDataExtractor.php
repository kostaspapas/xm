<?php

declare(strict_types=1);

namespace App\DataExtractors;

use App\Formatters\Formatter;

/**
 * Helpfull class to extract the data for front end
 */
class HistoricalQuotesDataExtractor
{
    private $historicalQuotes = [];
    private $historicalDates = [];
    private $historicalOpenPrices = [];
    private $historicalClosePrices = [];

    public function __construct(Formatter $formatter, array $historicalQuotes)
    {
        foreach ($historicalQuotes as $quote) {
            $formattedOpenPrice = $formatter->toFloatFormat($quote['open']);
            $formattedClosePrice = $formatter->toFloatFormat($quote['close']);

            $this->historicalQuotes[] = [
                'date' => date("Y-m-d", (int)$quote['date']),
                'open' => $formattedOpenPrice,
                'high' => $formatter->toFloatFormat($quote['high']),
                'low' => $formatter->toFloatFormat($quote['low']),
                'close' => $formattedClosePrice,
                'volume' => $formatter->toVolumeFormat($quote['volume']),
            ];

            $this->historicalDates[] = $quote['date'];
            $this->historicalOpenPrices[] = $formattedOpenPrice;
            $this->historicalClosePrices[] = $formattedClosePrice;
        }
    }

    public function getHistoricalQuotes(): array
    {
        return array_reverse($this->historicalQuotes);
    }

    /**
     * Get only the dates
     *
     * @return string
     */
    public function getHistoricalDates(): string
    {
        return json_encode(array_reverse($this->historicalDates),0,512);
    }

    /**
     * Get only the open prices
     *
     * @return array
     */
    public function getHistoricalOpenPrices(): array
    {
        return array_reverse($this->historicalOpenPrices);
    }

    /**
     * Get only the close prices
     *
     * @return array
     */
    public function getHistoricalClosePrices(): array
    {
        return array_reverse($this->historicalClosePrices);
    }
}
