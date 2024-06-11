<?php

namespace App\Events;

use App\Application\DTOs\OrderDTO;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public OrderDTO $orderDTO;
    public function __construct(OrderDTO $orderDTO)
    {
        $this->orderDTO = $orderDTO;
    }
}
