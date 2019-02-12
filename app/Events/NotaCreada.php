<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotaCreada implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $nota;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nota)
    {
        $this->nota = $nota;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('nota-channel');
    }
}
