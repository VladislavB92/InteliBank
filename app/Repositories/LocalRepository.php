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
        $currency = Currency::find($symbol);

        return $currency->rate;
    }
}
