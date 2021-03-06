<?php

namespace App\Listeners;

use App\Events\TransactionSaved;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class StoreTransaction
{
    public function handle(TransactionSaved $event)
    {
        $sendersData = $event->senderData;
        $recipientsData = $event->request->post();

        $recipientsAccountCurrency = DB::table('accounts')
            ->select('currency')
            ->where('account_number', $recipientsData['account_number'])
            ->get();

        $transactionData = [
            'senders_name' => $sendersData->account_holder,
            'senders_account' => $sendersData->account_number,
            'senders_account_currency' =>  $sendersData->currency,
            'amount' => (float) $recipientsData['amount'],
            'recipients_name' => $recipientsData['account_holder'],
            'recipients_account' => $recipientsData['account_number'],
            'recipients_account_currency' => $recipientsAccountCurrency[0]->currency
        ];

        $transaction = (new Transaction)->fill($transactionData);
        $transaction->save();
    }
}
