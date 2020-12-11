<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\CurrencyRateService;

class UpdateExchangeRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public CurrencyRateService $currencyExchangeService;

    public function __construct()
    {
        $this->currencyExchangeService = new CurrencyRateService;
    }

    public function handle()
    {
        $this->currencyExchangeService->execute();
    }
}
