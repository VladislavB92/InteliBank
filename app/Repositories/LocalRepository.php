<?php

namespace App\Repositories;

use App\Models\Currency;

class LocalRepository
{
    function getAll()
    {
        return Currency::all();
    }

    function getBySymbol(string $symbol)
    {
        $currency = Currency::all();
        return $currency->find($symbol)->rate;
    }
}
