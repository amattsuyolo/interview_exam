<?php

namespace App\Service;

use App\Repository\ExchangeRateRepository;

class ExchangeRateService
{
    private $exchangeRateRepository;

    public function __construct(
        ExchangeRateRepository $exchangeRateRepository
    ) {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }
    /**
     * 確定有無對應匯率資料
     */
    public function checkExchangeRateType($from, $to)
    {
        $exchange_rate = $this->exchangeRateRepository->getExchangeRate();
        if (!array_key_exists($from, $exchange_rate)) return false;
        if (!array_key_exists($to, $exchange_rate[$from])) return false;
        if ($exchange_rate[$from][$to] < 0) return false;
        return true;
    }
    /**
     * 取得轉換匯率後的數字
     */
    public function getExchangedAmount($from, $to, $amount)
    {
        $exchange_rate = $this->exchangeRateRepository->getExchangeRate();
        $exchanged_amount = $exchange_rate[$from][$to] * $amount;
        return $exchanged_amount;
    }
}
