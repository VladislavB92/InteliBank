<?php

namespace App\Providers;

use App\Repositories\CurrenciesRepository;
use App\Repositories\LocalRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(CurrenciesRepository::class, LocalRepository::class);
    }
}
