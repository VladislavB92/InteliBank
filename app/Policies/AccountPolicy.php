<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Account $account)
    {

        return auth()->user()->name === $account->account_holder;
    }
}
