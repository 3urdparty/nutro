<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeliveryAccepted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $delivery_id;
    public $delivery_person_id;
    public function __construct(int $delivery_id, int $delivery_person_id)
    {
        $this->delivery_id = $delivery_id;
        $this->delivery_person_id = $delivery_person_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


    public function broadcastWith(): array
    {
        return [
            'delivery_id' => $this->delivery_id,
            'delivery_person_id' => $this->delivery_person_id,
        ];
    }
    public function broadcastAs(): string
    {
        return 'delivery-accepted';
    }
    public function broadcastOn(): array
    {

        return ['deliveries'];
    }
}
