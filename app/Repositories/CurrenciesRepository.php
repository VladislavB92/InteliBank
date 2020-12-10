<?php

namespace App\Repositories;
use App\Models\Currency;

interface CurrenciesRepository
{
    public function getBySymbol(string $symbol): float;
}