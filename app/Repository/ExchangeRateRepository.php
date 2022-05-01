<?php

namespace App\Repository;

/**
 * 用來取得ExchangeRate資源，可以是不同DB或檔案
 */
class ExchangeRateRepository
{
    const EXCHANGE_RATE =
    [
        "currencies" => [
            "TWD" => [
                "TWD" => 1,
                "JPY" => 3.669,
                "USD" => 0.03281
            ],
            "JPY" => [
                "TWD" => 0.26956,
                "JPY" => 1,
                "USD" => 0.00885
            ],
            "USD" => [
                "TWD" => 30.444,
                "JPY" => 111.801,
                "USD" => 1
            ]
        ]
    ];
    public function getExchangeRate()
    {
        return self::EXCHANGE_RATE["currencies"];
    }
}
