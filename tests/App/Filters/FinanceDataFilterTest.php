<?php
declare(strict_types=1);

namespace App\Filters;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class FinanceDataFilterTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetData(array $originalData, array $expectedData): void
    {
        // Arrange
        $startDate = "03/03/2022"; // Mar 03 2022
        $endDate = "03/04/2022"; // Mar 04 2022
        $filter = new FinanceDataFilter($originalData);

        // Act
        $actualData = $filter->getData($startDate, $endDate);

        // Assert
        self::assertEquals($expectedData, $actualData);
    }

    public function dataProvider(): array
    {
        $originalData = $this->getOriginalData();
        $expectedData = $this->getExpectedData();

        return [
            [$originalData, $expectedData],
            [[], []]
        ];
    }

    private function getOriginalData(): array
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
                "volume" => 1161803,
                "adjclose" => 1.5700000524520874
            ],
            [
                "date" => 1646352000, // Mar 04 2022 00:00:00 (UTC)
                "open" => 1.559999942779544,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => 1161804,
                "adjclose" => 1.5700000524520874
            ],
            [
                "date" => 1646438400, // Mar 05 2022 00:00:00 (UTC)
                "open" => 1.559999942779545,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => 1161805,
                "adjclose" => 1.5700000524520874
            ],
        ];
    }

    private function getExpectedData(): array
    {
        return [
            [
                "date" => 1646265600, // Mar 03 2022 00:00:00 (UTC)
                "open" => 1.559999942779543,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => 1161803,
                "adjclose" => 1.5700000524520874
            ],
            [
                "date" => 1646352000, // Mar 04 2022 00:00:00 (UTC)
                "open" => 1.559999942779544,
                "high" => 1.6299999952316284,
                "low" => 1.559999942779541,
                "close" => 1.5700000524520874,
                "volume" => 1161804,
                "adjclose" => 1.5700000524520874
            ],
        ];
    }
}
