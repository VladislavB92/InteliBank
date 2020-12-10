<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'senders_name',
        'senders_account',
        'senders_account_currency',
        'amount',
        'recipients_name',
        'recipients_account',
        'recipients_account_currency'
    ];
}
