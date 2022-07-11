<?php
declare(strict_types=1);

namespace App\DataExtractors;

use PHPUnit\Framework\TestCase;
use App\Formatters\FinanceFormatter;

class HistoricalQuotesDataExtractorTest extends TestCase
{
    private $dataExtractor;

    public function setUp(): void
    {
        parent::setUp();

        $formatter = new FinanceFormatter();
        $originalHistoricalQuotes = $this->getOriginalHistoricalQuotes();
        $this->dataExtractor = new HistoricalQuotesDataExtractor(
            $formatter,
            $originalHistoricalQuotes
        );
    }

    public function testGetHistoricalQuotes():void
    {
        // Arrange
        $expectedHistoricalQuotes = array_reverse($this->getExpectedHistoricalQuotes());

        // Act
        $actualHistoricalQuotes = $this->dataExtractor->getHistoricalQuotes();

        // Assert
        self::assertEquals($expectedHistoricalQuotes, $actualHistoricalQuotes);
    }

    private function getOriginalHistoricalQuotes(): array
    {
        return [
            [
                "date" => 1646092800, // Mar 01 2022 00:00:00 (UTC)
                "open" => 1.5499999523162841,
                "high" => 1.6299999952316284,
                "low" => 1.5099999904632568,
                "close" => 1.6200000047683716,
                "volume" => 1161801,
                "adjclose" => 1.6200000047683716
            ],
            [
                "date" => 1646179200, // Mar 02 2022 00:00:00 (UTC)
                "open" => 1.559999942779542,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => 1161802,
                "adjclose" => 1.5700000524520874
            ],
            [
                "date" => 1646265600, // Mar 03 2022 00:00:00 (UTC)
                "open" => 1.559999942779543,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => null,
                "adjclose" => 1.5700000524520874
            ],
        ];
    }

    private function getExpectedHistoricalQuotes(): array
    {
        return [
            [
                "date" => "2022-03-01", // Mar 01 2022 00:00:00 (UTC)
                "open" => 1.55,
                "high" => 1.63,
                "low" => 1.51,
                "close" => 1.62,
                "volume" => 1161801,
            ],
            [
                "date" => "2022-03-02", // Mar 02 2022 00:00:00 (UTC)
                "open" => 1.56,
                "high" => 1.63,
                "low" => 1.56,
                "close" => 1.57,
                "volume" => 1161802,
            ],
            [
                "date" => "2022-03-03", // Mar 03 2022 00:00:00 (UTC)
                "open" => 1.56,
                "high" => 1.63,
                "low" => 1.56,
                "close" => 1.57,
                "volume" => 0,
            ],
        ];
    }
}
