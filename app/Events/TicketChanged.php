<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $numberOpenedTicket;
    public $numberInProgressTicket;
    public $numberClosedTicked;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->numberOpenedTicket = Ticket::where('status', 'aberto')->count();
        $this->numberInProgressTicket = Ticket::where('status', 'em-andamento')->count();
        $this->numberClosedTicked = Ticket::where('status', 'fechado')->count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('ticket');
    }

    /* public function broadcastAs()
    {
        return "TicketChanged";
    }

    public function broadcastWith()
    {
        return [
            'numberOpenedTicket' => $this->numberOpenedTicket,
            'numberInProgressTicket' => $this->numberInProgressTicket,
            'numberClosedTicked' => $this->numberClosedTicked
        ];
    } */
}
