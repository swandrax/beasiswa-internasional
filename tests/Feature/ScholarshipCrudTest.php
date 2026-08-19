<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScholarshipCrudTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function test_can_create_scholarship()
    {
        $admin = \App\Models\User::factory()->create(['role' => 'admin']);
        
        $response = $this->actingAs($admin, 'sanctum')->postJson('/api/scholarships', [
            'title' => 'Beasiswa LPDP',
            'description' => 'Beasiswa penuh',
            'provider' => 'Kemenkeu',
            'deadline' => '2027-12-31',
            'status' => 'open',
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_scholarships()
    {
        $user = \App\Models\User::factory()->create();
        \App\Models\Scholarship::factory(3)->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/scholarships');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data')
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'title', 'description', 'provider', 'deadline', 'status']
                     ],
                     'current_page', 'last_page', 'total'
                 ]);
    }
}
