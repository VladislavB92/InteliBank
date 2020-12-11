<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

interface CurrenciesRepository
{
    public function getAll(): Collection;
}