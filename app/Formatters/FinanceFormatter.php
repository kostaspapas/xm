<?php

declare(strict_types=1);

namespace App\Formatters;

/**
 * Helpfull class to format the data from API
 */
class FinanceFormatter implements Formatter
{
    /**
     * Get a date from a timestamp
     *
     * @param int $originalTimestamp
     * @return string
     */
    public function toDateFormat(int $originalTimestamp): string
    {
        return date(self::DATE_FORMAT, $originalTimestamp);
    }

    /**
     * Round a float
     *
     * @param float|null $originalPrice
     * @return float|null
     */
    public  function toFloatFormat(?float $originalPrice): ?float
    {
        return round($originalPrice, 4);
    }

    /**
     * Get the volume number. Get 0 if null.
     *
     * @param int|null $originalVolume
     * @return int
     */
    public function toVolumeFormat(?int $originalVolume): int
    {
        return $originalVolume ?? 0;
    }
}
