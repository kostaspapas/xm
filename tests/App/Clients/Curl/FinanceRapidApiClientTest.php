<?php
declare(strict_types=1);

namespace App\Clients\Curl;

use App\Clients\FinanceRapidApiClient;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use Tests\TestCase;

/**
 * @internal
 */
class FinanceRapidApiClientTest extends TestCase
{
    private $client;
    private $baseUrl;
    private $curlMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->setUpCurlMock();
        $this->baseUrl = rtrim(config('constants.finance_rapid_api_base_url'), '/');
        $this->client = new FinanceRapidApiClient($this->curlMock, $this->baseUrl);
    }

    private function setUpCurlMock()
    {
        $curlMock = $this->createMock(Curl::class);
        $this->curlMock = $curlMock;
        $this->app->singleton(Curl::class, static function () use ($curlMock) {
            return $curlMock;
        });
    }

    public function testGetHistoricalData(): void
    {
        // Arrange
        $expectedMethodOfCurlClass = 'get';
        $companySymbol = "AAA";
        $expectedUrl = $this->baseUrl . '/get-historical-data?symbol=' . $companySymbol ;
        $header = [
            'X-RapidAPI-Key' => '7bd84e4160msh353b310d5aeacbfp197fc1jsna6d34fd53e18',
            'X-RapidAPI-Host' => 'yh-finance.p.rapidapi.com'
        ];

        $expectedResponse = $this->getExpecedResponse();

        $this->expectsCurlMethodCalled(
            $expectedMethodOfCurlClass,
            $expectedUrl,
            $header,
            $expectedResponse
        );

        // Act
        $actualResponse = $this->client->getHistoricalData($companySymbol);

        // Assert
        $this->assertEquals((object) $expectedResponse, $actualResponse);
    }

    private function expectsCurlMethodCalled(
        string $method,
        string $url,
        array $headers,
        array $response
    ): InvocationMocker {

        $args = [$url, $headers];

        return $this->curlMock
            ->expects(self::once())
            ->method($method)
            ->with(...$args)
            ->willReturn((object) $response)
            ;
    }

    private function getExpecedResponse(): array
    {
        return [
            "prices" => [
                [
                    "date" => 1657287000,
                    "open" => 1.5499999523162842,
                    "high" => 1.6299999952316284,
                    "low" => 1.5099999904632568,
                    "close" => 1.6200000047683716,
                    "volume" => 1161800,
                    "adjclose" => 1.6200000047683716
                ],
                [
                    "date" => 1657200600,
                    "open" => 1.559999942779541,
                    "high" => 1.6299999952316284,
                    "low" => 1.559999942779541,
                    "close" => 1.5700000524520874,
                    "volume" => 1491600,
                    "adjclose" => 1.5700000524520874
                ],
            ],
            "isPending" => false,
            "firstTradeDate" => 733674600,
            "id" => "",
            "timeZone" => [
                "gmtOffset" => -14400
            ],
            "eventsData" => []
        ];
    }
}
