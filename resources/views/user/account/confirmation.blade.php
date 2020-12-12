<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit or confirm payment details ') }}
        </h2>
    </x-slot>

    <div class="container w-full md:w-5/5 xl:w-5/5 mx-auto px-2">
        <div>
            <h1>Recipients name: {{ $recipientsName }}</h1>
            <h1>Recipients account number: {{ $paymentData['account_number'] }}</h1>
            <h1>Amount: {{ $account->currency }} {{ sprintf("%.2f", $paymentData['amount']) }}</h1>
            <h1>Conversation rate: {{ sprintf("%.2f", $rate) }}</h1>
            <h1>Amount recipient receive: {{ $recipientsCurrency }}
                @if($convertedAmount > 0)
                {{ sprintf("%.2f", $convertedAmount)}}
                @elseif($convertedAmount == 0)
                {{ sprintf("%.2f", $paymentData['amount']) }}
                @endif
            </h1>

        </div><br>
        <form method="post" action="{{ route('accounts.update', ['account' => $account]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="hidden" class="form-control" id="currency" name="currency" value={{ $recipientsCurrency }}>
                <input type="hidden" class="form-control" id="account_holder" name="account_holder" value={{ $recipientsName }}>
                <input type="hidden" class="form-control" id="account_number" name="account_number" value={{ $paymentData['account_number'] }}>
                <input type="hidden" class="form-control" id="amount" name="amount" value={{ sprintf("%.2f", $paymentData['amount']) }}>
                <div class="form-group">
                    <button type="submit" class="border border-teal-500 bg-teal-500 text-white rounded-md 
                    px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-teal-600 
                    focus:outline-none focus:shadow-outline" onclick="clicked(event)">CONFIRM AND SEND</button>
                </div>
        </form>
    </div>
    <button class="border border-yellow-500 bg-yellow-500 text-white 
    rounded-md px-4 py-2 m-2 transition duration-500 ease select-none 
    hover:bg-yellow-600 focus:outline-none focus:shadow-outline" 
    onclick="window.location.href='{{ route('accounts.edit', ['account' => $account]) }}'">Edit</button>
    <button class="border border-red-500 bg-red-500 text-white rounded-md px-4 py-2 m-2 
    transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" 
    onclick="window.location.href='{{ route('all') }}'">Cancel payment</button>

    <script>
        function clicked(e) {
            if (!confirm('Send?')) {
                e.preventDefault();
            }
        }

    </script>
    </div>

</x-app-layout>
