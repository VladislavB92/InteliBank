<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class LocalRepository
{
    function getAll()
    {
        return Currency::all();
    }
}
