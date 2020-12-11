<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Events\PaymentMade;
use App\Repositories\LocalRepository;
use App\Services\CurrencyRateService;

class AccountsController extends Controller
{
    // public $currenciesRepository;

    public function __construct(LocalRepository $currenciesRepository)
    {
        $this->middleware('auth');
        // $this->currenciesRepository = $currenciesRepository;
    }

    public function index()
    {
        $user = auth()->user();

        $accounts = (new Account)->where('account_holder', $user->name)->get();

        $currencyRate = new CurrencyRateService();
        $currencyRate->execute();

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

        $account->load('outgoingTransaction');
        $account->outgoingTransaction();

        $account->load('incomingTransaction');
        $account->incomingTransaction();

        $loggedUser = auth()->user()->name;

        return view('user.account.details', ['account' => $account, 'loggedUser' => $loggedUser]);
    }

    public function edit(Account $account)
    {
        $this->authorize('edit', $account);

        return view('user.account.operations', ['account' => $account]);
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);
        $loggedUser = auth()->user()->name;

        $paymentData = $request->post();

        $sendersAccountCurrency = $account->currency;

        $recipientsName = $paymentData['account_holder'];
        $recipientsAccountNumber = $paymentData['account_number'];

        $recipientsAccountCurrency = $account
            ->select('currency')
            ->where('account_number',  $recipientsAccountNumber)
            ->get()[0]->currency;

        if ($sendersAccountCurrency !== $recipientsAccountCurrency) {
            $convertedAmount =
                $paymentData['amount'] /
                $this->currenciesRepository->getBySymbol($sendersAccountCurrency);
        }

        $account
            ->where(['account_holder' => $recipientsName, 'account_number' => $recipientsAccountNumber])
            ->increment('amount', $convertedAmount);

        $account
            ->decrement('amount', $paymentData['amount']);

        event(new PaymentMade($account, $request));

        return view('user.account.details', ['account' => $account, 'loggedUser' => $loggedUser]);
    }

    public function destroy($id)
    {
    }
}
