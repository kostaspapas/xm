<?php

declare(strict_types=1);

namespace App\Filters;

use DateTime;

/**
 * Helpful class to filter the data from API
 */
class FinanceDataFilter
{
    private $originalData;

    public function __construct(array $originalData)
    {
        $this->originalData = $originalData;
    }

    /**
     * Get only the data for these dates
     *
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getData(string $startDate, string $endDate): array
    {
        $filteredData = [];
        $startTimestamp = $this->getTimestamp($startDate);
        $endTimestamp = $this->getTimestamp($endDate);

        foreach ($this->originalData as $data) {
            if ($startTimestamp <= $data['date'] && $data['date'] <= $endTimestamp) {
                $filteredData[] = $data;
            }
        }

        return $filteredData;
    }

    /**
     * Get the timestamp of a date
     *
     * @param string $initialDate
     * @return int
     */
    private function getTimestamp(string $initialDate): int
    {
        $d = DateTime::createFromFormat('m/d/Y H:i:s', $initialDate . " 00:00:00");
        return $d->getTimestamp();
    }
}
