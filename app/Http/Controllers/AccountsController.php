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

    public function store(Request $request)
    {
        //
    }

    public function show(Account $account)
    {
        $this->authorize('show', $account);

        return view('user.account.details', ['account' => $account]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
