<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;

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
        //
    }

    public function store(Request $request, Account $account)
    {
        $account = (new Account)->fill($request->all());
        $account->save();

        return redirect()->route('all');
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
        $amount = $paymentData['amount'];

        $account
        ->where(['account_holder' => $recipientsName, 'account_number' => $accountNumber])
        ->increment('amount', $amount);

        $account
        ->decrement('amount', $amount);

        return redirect()->route('accounts.show', $account);
    }

    public function destroy($id)
    {
        //
    }
}
