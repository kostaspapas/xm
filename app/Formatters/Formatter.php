<?php

declare(strict_types=1);

namespace App\Formatters;

interface Formatter
{
    const DATE_FORMAT = "Y-m-d";

    public function toDateFormat(int $originalTimestamp): string;

    public function toFloatFormat(?float $originalPrice): ?float;

    public function toVolumeFormat(?int $originalVolume): int;
}
