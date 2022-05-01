<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRateRequest;

class ExchangeRateController extends Controller
{
    public function index(ExchangeRateRequest $request)
    {
        $exchange_rate =
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
        $from = $request->from ?? "TWD";
        $to = $request->to ?? "JPY";
        $amount = $request->amount ?? 100876;
        $exchanged_amount = $exchange_rate["currencies"][$from][$to] * $amount;
        $formatted_result = number_format(
            $exchanged_amount,
            2,
            '.',
            ','
        );
        $return_data = [
            "status" => "success",
            "code" => 200,
            "message" => "成功,正常回傳",
            "data" => $formatted_result,
        ];
        return response()->json($return_data);
    }
}
