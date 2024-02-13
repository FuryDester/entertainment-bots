<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function healthcheck_ok(): void
    {
        $response = $this->get('/api/v1/healthcheck');

        $response->assertStatus(200);
    }
}
