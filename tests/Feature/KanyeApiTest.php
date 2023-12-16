<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class KanyeApiTest extends TestCase
{
    /**
     * Test for successful kayne API response.
     */
    public function test_kayne_api_successful_response(): void
    {
        $quoteManager = app('quote_manager');
        $response = $quoteManager->driver('kanye')->make();

        $this->assertJson($response);
    }
}
