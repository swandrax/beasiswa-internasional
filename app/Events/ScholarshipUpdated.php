<?php

namespace App\Events;

use App\Models\Scholarship;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScholarshipUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $scholarship;
    public $action;

    /**
     * Create a new event instance.
     */
    public function __construct(Scholarship $scholarship, $action = 'updated')
    {
        $this->scholarship = $scholarship;
        $this->action = $action;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('scholarships'),
        ];
    }
    
    public function broadcastAs()
    {
        return 'scholarship.' . $this->action;
    }
}
