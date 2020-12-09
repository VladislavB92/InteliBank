<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make new payment ') }}
        </h2>
    </x-slot>

    <div class="container w-full md:w-5/5 xl:w-5/5 mx-auto px-2">
        <div>
            <h1>Account holder: {{ $account->account_holder }}</h1>
            <h2>Account number: {{ $account->account_number }}</h2>
            <h2>Avalaible account balance: {{ $account->currency }} {{ $account->amount }}</h2>
        </div><br>
        <form method="post" action="{{ route('accounts.update', ['account' => $account]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Recipient's name</label>
                <input type="text" class="form-control" id="account_holder" name="account_holder" placeholder="">
            </div>
            <div class="form-group">
                <label for="name">Recipient's account number</label>
                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="">
            </div>
            <div class="form-group">
                <label for="name">Amount</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>

    </div>
    </div>



</x-app-layout>
