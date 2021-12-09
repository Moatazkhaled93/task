<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class DashboardEndpointTest extends TestCase
{
    use MigrateFreshSeedOnce, WithoutMiddleware;

    public function testDashboardEndpointSuccessful()
    {
        $response = $this->get(route('dashboard'), [
            'headers' => [
                'Authorization' => 'Bearer 1234567890',
                'Accept' => 'application/json',
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "message",
            'data' => [
                'totals' => [
                    'daily' => [
                        'signed_in',
                        'sign_out',
                        'expected',
                        'temperature' => [
                            'failed',
                            'successful'
                        ]
                    ]
                ],
            ],
        ]);
    }
}
