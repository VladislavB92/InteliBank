<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'senders_name',
        'senders_account',
        'senders_account_currency',
        'ammount',
        'recipients_name',
        'recipients_account',
        'recipients_account_currency'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'account_number', 'senders_account');
    }
}
