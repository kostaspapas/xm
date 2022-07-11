<?php

declare(strict_types=1);

namespace App\Clients\Curl;

use App\Helpers\Assert;
use stdClass;

/**
 * The parent client class
 */
abstract class BaseCurlClient
{
    /**
     * @var string The base url
     */
    protected $url;

    /**
     * @var array Keeps the default headers
     */
    protected $defaultHeaders = [];

    /**
     * @var Curl Instance of Curl Class. It has curl helper methods
     */
    private $curl;

    public function __construct(Curl $curl, string $baseUrl)
    {
        Assert::url($baseUrl);

        $this->curl = $curl;
        $this->url = trim($baseUrl, '/');
    }

    /**
     * Use http GET
     *
     * @param string $url
     * @param array $headers
     * @return stdClass
     */
    protected function httpGet(string $url, array $headers = []): stdClass
    {
        return $this->curl->get($this->getUrl($url), $this->getDefaultHeaders($headers));
    }

    /**
     * Get the default headers
     *
     * @param array $extraHeaders You may add extra headers
     * @return array returns the headers
     */
    protected function getDefaultHeaders(array $extraHeaders = []): array
    {
        return array_merge($this->defaultHeaders, $extraHeaders);
    }

    /**
     * Get the full url of the call
     *
     * @param string $urlPart
     * @return string
     */
    protected function getUrl(string $urlPart): string
    {
        if ($this->isFullUrl($urlPart)) {
            return $urlPart;
        }

        return $this->url . '/' . trim($urlPart, '/');
    }

    /**
     * Validate a url
     *
     * @param string $url
     * @return bool
     */
    protected function isFullUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
    }
}
