<?php

namespace App\Events;

use App\Promotion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PromotionAdded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Promotion
     */
    public $promotion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Promotion $promotion)
    {
        //
        $this->promotion = $promotion;
    }

    public function broadcastAs(){
        return 'new-promotion-added';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('new-promotion');
    }
}
