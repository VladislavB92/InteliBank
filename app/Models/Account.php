<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Transaction;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_holder',
        'account_number',
        'currency',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_holder', 'name');
    }

    public function outgoingTransaction()
    {
        return $this->hasMany(
            Transaction::class,
            'senders_account',
            'account_number'
        );
    }

    public function incomingTransaction()
    {
        return $this->hasMany(
            Transaction::class,
            'recipients_account',
            'account_number'
        );
    }
}
