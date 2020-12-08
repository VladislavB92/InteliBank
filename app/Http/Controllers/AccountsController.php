<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;

class AccountsController extends Controller
{
    public function index(User $user)
    {
        $user->load('accounts');
        $user->accounts();
        
        $user = auth()->user();
        $loggedUserAccounts = $user->accounts;

        return view('user.account.all', ['accounts' => $loggedUserAccounts]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        $user->load('accounts');
        $user->accounts();

        $user = auth()->user();
        $loggedUserAccounts = $user->accounts;

        return view('user.account.details', ['account' => $loggedUserAccounts]);
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
