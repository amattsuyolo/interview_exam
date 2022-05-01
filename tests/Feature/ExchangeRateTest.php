<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class ExchangeRate extends TestCase
{
    /**
     * ./vendor/bin/phpunit --group=exchangeRate
     * @group exchangeRate
     * @test
     * @return void
     */
    public function test_get_http_response_and_json_structure()
    {
        $data = [
            "from" => "TWD",
            "to" => "JPY",
            "amount" => 1000
        ];
        $response = $this->call('GET', '/api/exchangeRate', $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "code",
                "message",
                "data"
            ]);
    }
    /**
     * ./vendor/bin/phpunit --group=exchangeRate
     * @group exchangeRate
     * @test
     * @dataProvider provideExchangeRateErrorRequest
     * @return void
     */
    public function test_get_proper_error($expectedResponse, $expectedCode, $input)
    {
        $response = $this->call('GET', '/api/exchangeRate', $input);
        $response->assertStatus($expectedCode)
            ->assertJson($expectedResponse);
    }
    public function provideExchangeRateErrorRequest()
    {
        $no_neccessary_parameter_response = [
            "status" => "error",
            "code" => 400,
            "message" => "The from field is required.",
            "data" => NULL
        ];
        $not_number_response = [
            "status" => "error",
            "code" => 400,
            "message" => "The amount must be a number.",
            "data" => NULL
        ];
        return [
            '沒有提供必要的參數' => [
                $no_neccessary_parameter_response,
                400,
                [
                    "to" => "TWD"
                ]
            ],
            'amount不為數字' => [
                $not_number_response,
                400,
                [
                    "from" => "TWD",
                    "to" => "JPY",
                    "amount" => "hi"
                ]
            ],
        ];
    }
}
