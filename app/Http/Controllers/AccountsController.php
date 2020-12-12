<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Events\TransactionSaved;
use App\Repositories\LocalRepository;
use App\Events\PaymentMade;

class AccountsController extends Controller
{
    public LocalRepository $currenciesRepository;

    public function __construct(LocalRepository $currenciesRepository)
    {
        $this->middleware('auth');
        $this->currenciesRepository = $currenciesRepository;
    }

    public function index()
    {
        $user = auth()->user();
        $accounts = (new Account)->where('account_holder', $user->name)->get();

        return view('user.account.all', ['accounts' => $accounts]);
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

    public function collectTransactionData(Request $request, Account $account)
    {
        $paymentData = $request->post();

        $this->validate($request, [
            'account_holder' => 'required',
            'account_number' => 'exists:accounts|required',
            'amount' => 'required|numeric'
        ]);

        $recipientsAccountCurrency = $account
            ->select('currency')
            ->where('account_number', $paymentData['account_number'])
            ->get()[0]->currency;

        if ($account->currency === $recipientsAccountCurrency) {
            $rate = 0;
            $convertedAmount = 0;
        } elseif ($account->currency !== $recipientsAccountCurrency && $account->currency === 'EUR') {
            $rate = $this->currenciesRepository->getBySymbol($recipientsAccountCurrency);
            $convertedAmount = $paymentData['amount'] * $rate;
        } elseif ($account->currency !== $recipientsAccountCurrency && $recipientsAccountCurrency === 'EUR') {
            $rate = 1 / $this->currenciesRepository->getBySymbol($account->currency);
            $convertedAmount = $paymentData['amount'] * $rate;
        }

        return view('user.account.confirmation', [
            'account' => $account,
            'recipientsName' => $paymentData['account_holder'],
            'sendersCurrency' => $account->currency,
            'paymentData' => $paymentData,
            'recipientsCurrency' => $recipientsAccountCurrency,
            'rate' => $rate,
            'convertedAmount' => $convertedAmount
        ]);
    }

    public function update(Request $request, Account $account)
    {
        $this->authorize('update', $account);
        $loggedUser = auth()->user()->name;

        event(new PaymentMade($account, $request));
        event(new TransactionSaved($account, $request));

        return redirect()->route('details', $account->account_number)->with('success', 'Payment sent successfully!');
    }
}
