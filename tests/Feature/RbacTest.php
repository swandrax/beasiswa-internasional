<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RbacTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function test_admin_can_create_scholarship()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/scholarships', [
            'title' => 'Test',
            'description' => 'Test',
            'provider' => 'Test',
            'deadline' => '2030-01-01',
            'country' => 'US',
            'url' => 'http://example.com'
        ]);

        $response->assertStatus(201);
    }

    public function test_user_cannot_create_scholarship()
    {
        $user = \App\Models\User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/scholarships', [
            'title' => 'Test',
            'description' => 'Test',
            'provider' => 'Test',
            'deadline' => '2030-01-01',
            'country' => 'US',
            'url' => 'http://example.com'
        ]);

        $response->assertStatus(403);
    }
}
