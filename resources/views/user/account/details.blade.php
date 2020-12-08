<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account overview for ') }}{{ $account->account_number }}
        </h2>
    </x-slot>
    <div>
        <h1>Account holder: {{ $account->account_holder }}</h1>
        <h2>Account number: {{ $account->account_number }}</h2>
        <h2>Account balance: {{ $account->currency }} {{ $account->amount }}</h2>
    </div>

<a href="{{ route('transactions_history', ['account' => $account]) }}">See transaction history</a><br>
<a href="{{ route('operations', ['account' => $account]) }}">Make new payment</a>

</x-app-layout>
