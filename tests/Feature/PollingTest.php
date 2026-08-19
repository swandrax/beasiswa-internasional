<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PollingTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    public function test_can_poll_new_updates()
    {
        $oldScholarship = \App\Models\Scholarship::factory()->create([
            'updated_at' => now()->subDays(2)
        ]);

        $newScholarship = \App\Models\Scholarship::factory()->create([
            'updated_at' => now()->addMinutes(1)
        ]);

        $timestamp = now()->toDateTimeString();

        $response = $this->getJson('/api/polling/scholarships?last_checked=' . $timestamp);

        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data')
                 ->assertJsonPath('data.0.id', $newScholarship->id);
    }
}
