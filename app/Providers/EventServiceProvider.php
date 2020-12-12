<?php

namespace App\Providers;

use App\Events\PaymentMade;
use App\Events\TransactionSaved;
use App\Listeners\ChangeAccountAmount;
use App\Listeners\StoreTransaction;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(
            TransactionSaved::class,
            [StoreTransaction::class, 'handle']
        );

        Event::listen(
            PaymentMade::class,
            [ChangeAccountAmount::class, 'handle']
        );
    }
}
