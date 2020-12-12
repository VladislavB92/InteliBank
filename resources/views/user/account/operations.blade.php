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
            <h2>Avalaible account balance: {{ $account->currency }} {{ sprintf("%.2f", $account->amount) }}</h2>
        </div><br>

        <form method="post" action="{{ route('confirmation', ['account' => $account]) }}">
            @csrf
            @method('POST')
            <div class="form-group">
                <label class="block" for="account_holder">
                    <span class="text-gray-700">Recipient's name</span>
                    <input type="text" class="form-input mt-1 block w-full form-control @error('account_holder') border-red-500 @enderror" 
                    id="account_holder" name="account_holder">
                </label>
                @error('account_holder')
                <div>
                    <p>Enter a valid name</p>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="block" for="account_number">
                    <span class="text-gray-700">Recipient's account number</span>
                    <input class="form-input mt-1 block w-full form-control @error('account_number') border-red-500 @enderror" 
                    type="text" id="account_number" name="account_number" value="{{ old('account_number') }}">
                </label>
                @error('account_number')
                <div>
                    <p>Enter a valid account number</p>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="block" for="amount">
                    <span class="text-gray-700">Amount</span>
                    <input class="form-input mt-1 block w-full form-control @error('amount') border-red-500 @enderror" 
                    type="text" id="amount" name="amount" value="{{ old('amount') }}">
                </label>
                @error('amount')
                <div>
                    <p>Enter amount with digits</p>
                </div>
                @enderror
            </div>
            <div class="form-group">
                <button class="border border-gray-700 bg-gray-700 text-white rounded-md px-4 py-2 m-2 
            transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" type="submit">Review payment</button>
            </div>
        </form>
        <button class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 
    transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" 
    onclick="window.location.href='{{ route('all') }}'">Cancel</button>

    </div>

</x-app-layout>
