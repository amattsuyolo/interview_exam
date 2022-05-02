<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use Mockery\MockInterface;
use App\Service\ExchangeRateService;
use App\Repository\ExchangeRateRepository;

class ExchangeRateTest extends TestCase
{
    /**
     * 
     * ./vendor/bin/phpunit --group=exchangeRateService
     * @group exchangeRateService
     * @return void
     */
    public function test_checkExchangeRateType()
    {
        $exchange_rate_data =  [
            "TWD1" => [
                "TWD" => 1,
                "JPY" => 3.669,
                "USD1" => 0.03281
            ],
            "JPY" => [
                "TWD" => 0.26956,
                "JPY" => 1,
                "USD" => 0.00885
            ]
        ];
        app()->instance(
            ExchangeRateRepository::class,
            Mockery::mock(ExchangeRateRepository::class, function (MockInterface $mock) use ($exchange_rate_data) {
                $mock->shouldReceive('getExchangeRate')
                    ->once()
                    ->andReturn($exchange_rate_data);
            })
        );
        $exchangeRateService = app()->make(ExchangeRateService::class);
        $response = $exchangeRateService->checkExchangeRateType("TWD1", "USD1");
        $this->assertTrue($response);
    }
}
