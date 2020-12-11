<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'currency';

    protected $fillable = [
        'bank',
        'currency',
        'rate'
    ];

    public function getRate(): float
    {
        return $this->rate;
    }
}
