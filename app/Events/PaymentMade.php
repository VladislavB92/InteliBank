<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\Account;

class PaymentMade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Account $account;
    public Request $request;

    public function __construct(Account $account, Request $request)
    {
        $this->account = $account;
        $this->request = $request;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
