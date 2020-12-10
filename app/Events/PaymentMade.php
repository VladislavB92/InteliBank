<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Account;

class PaymentMade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Account $senderData;
    public Request $request;

    public function __construct(Account $senderData, Request $request)
    {
        $this->senderData = $senderData;
        $this->request = $request;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
