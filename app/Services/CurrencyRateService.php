<?php

namespace App\Services;

use App\Models\Currency;
use App\Repositories\LocalRepository;
use App\Services\XmlManagerService;

class CurrencyRateService
{
    public function __construct()
    {
        $this->localRepository = new LocalRepository();
    }

    public function execute()
    {
        $exchangeRates = $this->localRepository->getAll();

        $data = (new XmlManagerService())->getCurrentRatesData();

        foreach ($data as $currencyData) {

            Currency::updateOrCreate([
                'bank' => 'LB',
                'currency' => $currencyData['ID']
            ], [
                'rate' => $currencyData['Rate']
            ]);
        }

        return $exchangeRates;
    }
}
