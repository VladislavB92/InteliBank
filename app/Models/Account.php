<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_holder',
        'account_number',
        'currency',
        'ammount'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'name', 'account_holder');
    }
}
