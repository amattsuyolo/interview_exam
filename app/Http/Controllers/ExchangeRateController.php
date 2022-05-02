<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRateRequest;
use App\Service\ExchangeRateService;

class ExchangeRateController extends Controller
{
    private $exchangeRateService;

    public function __construct(
        ExchangeRateService $exchangeRateService
    ) {
        $this->exchangeRateService = $exchangeRateService;
    }

    public function index(ExchangeRateRequest $request)
    {
        $from = $request->from;
        $to = $request->to;
        $amount = $request->amount;

        if (!$this->exchangeRateService->checkExchangeRateType($from, $to)) {
            $return_data = [
                "status" => "error",
                "code" => 400,
                "message" => "No matching currency exchange rate",
                "data" => NULL,
            ];
            return response()->json($return_data, 400);
        };
        $exchanged_amount = $this->exchangeRateService->getExchangedAmount($from, $to, $amount);

        $formatted_result = $this->formatNumber($exchanged_amount);

        $return_data = [
            "status" => "success",
            "code" => 200,
            "message" => "success,normal response",
            "data" => $formatted_result,
        ];
        return response()->json($return_data);
    }
    /**
     * 格式處理如下
     * 2549984.125 -> 2,549,984.13
     */
    public function formatNumber($input)
    {
        return number_format(
            round($input, 2),
            2,
            '.',
            ','
        );
    }
}
