<?php

declare(strict_types=1);

namespace App\Helpers;

use function filter_var;
use function sprintf;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Currencies;

final class Assert extends \Webmozart\Assert\Assert
{
    public static function url($value): void
    {
        $message = 'Expected an url. Got: %s';

        self::stringNotEmpty($value, $message);

        $isUrl = filter_var($value, FILTER_VALIDATE_URL);

        if (!$isUrl) {
            $formattedMessage = sprintf($message, self::typeToString($value));
            self::reportInvalidArgument($formattedMessage);
        }
    }

    public static function phoneNumberE164($value): void
    {
        $message = 'Expected a phone number in E164 format. Got: %s';

        $pattern = '/^\+[1-9]\d{8,14}$/';

        self::regex($value, $pattern, $message);
    }

    public static function countryCodeAlpha2($value): void
    {
        $message = 'Expected an alpha 2 country code. Got: %s';

        self::stringNotEmpty($value, $message);

        if (!Countries::exists($value)) {
            $formattedMessage = sprintf($message, self::typeToString($value));
            self::reportInvalidArgument($formattedMessage);
        }
    }

    public static function currencyCode($value): void
    {
        $message = 'Expected a currency code. Got: %s';

        self::stringNotEmpty($value, $message);

        if (!Currencies::exists($value)) {
            $formattedMessage = sprintf($message, self::typeToString($value));
            self::reportInvalidArgument($formattedMessage);
        }
    }
}
