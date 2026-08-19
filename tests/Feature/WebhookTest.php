<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebhookTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function test_webhook_can_update_scholarship_status()
    {
        $scholarship = \App\Models\Scholarship::factory()->create([
            'status' => 'open'
        ]);

        $payload = [
            'scholarship_id' => $scholarship->id,
            'status' => 'closed'
        ];

        $response = $this->postJson('/api/webhooks', $payload);

        $response->assertStatus(200)
                 ->assertJson(['processed' => true]);

        $this->assertDatabaseHas('scholarships', [
            'id' => $scholarship->id,
            'status' => 'closed'
        ]);
    }
}
