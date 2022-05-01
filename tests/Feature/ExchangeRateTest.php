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
        $response = $this->get('/api/exchangeRate', $data);
        $response->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "code",
                "message",
                "data"
            ]);
    }
}
