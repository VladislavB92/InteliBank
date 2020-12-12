<?php

namespace App\Listeners;

use App\Events\PaymentMade;
use App\Repositories\LocalRepository;

class ChangeAccountAmount
{
    public LocalRepository $currenciesRepository;

    public function __construct(LocalRepository $currenciesRepository)
    {
        $this->currenciesRepository = $currenciesRepository;
    }

    public function handle(PaymentMade $event)
    {
        $account = $event->account;
        $recipientsData = $event->request->post();

        $sendersAccountCurrency = $account->currency;

        $recipientsAccountNumber = $recipientsData['account_number'];

        if ($sendersAccountCurrency === $recipientsData['currency']) {

            $convertedAmount = $recipientsData['amount'];

        } elseif ($sendersAccountCurrency !== $recipientsData['currency'] && $sendersAccountCurrency === 'EUR') {

            $convertedAmount =
                $recipientsData['amount'] *
                $this->currenciesRepository->getBySymbol($recipientsData['currency']);

        } elseif ($sendersAccountCurrency !== $recipientsData['currency'] && $recipientsData['currency'] == 'EUR') {

            $convertedAmount =
                $recipientsData['amount'] *
                (1 / $this->currenciesRepository->getBySymbol($sendersAccountCurrency));
        }

        $account
            ->where(['account_number' => $recipientsAccountNumber])
            ->increment('amount', $convertedAmount);

        $account
            ->decrement('amount', $recipientsData['amount']);
    }
}
