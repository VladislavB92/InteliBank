<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Transaction;

class AccountsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $accounts = (new Account)->where('account_holder', $user->name)->get();

        return view('user.account.all', ['accounts' => $accounts]);
    }

    public function create()
    {
    }

    public function store(Request $request, Account $account)
    {
      
    }

    public function show(Account $account)
    {
        $this->authorize('show', $account);

        $account->load('transactions');
        $account->transactions();

        return view('user.account.details', ['account' => $account]);
    }

    public function edit(Account $account)
    {
        $this->authorize('edit', $account);

        return view('user.account.operations', ['account' => $account]);
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);

        $paymentData = $request->post();
        $recipientsName = $paymentData['account_holder'];
        $accountNumber = $paymentData['account_number'];

        $account
            ->where(['account_holder' => $recipientsName, 'account_number' => $accountNumber])
            ->increment('amount', $paymentData['amount']);

        $account
            ->decrement('amount', $paymentData['amount']);

        return redirect()->route('details', $account);
    }

    public function destroy($id)
    {
        
    }
}
