<html lang="en" class="antialiased">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="/Users/vlad/Desktop/Projects/InteliBank/public/css/app.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900 tracking-wider leading-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Account overview for ') }}{{ $account->account_number }}
            </h2>
        </x-slot>

        <div class="container w-full md:w-5/5 xl:w-5/5 mx-auto px-2">
            <h1>Account holder: {{ $account->account_holder }}</h1>
            <h2>Account number: {{ $account->account_number }}</h2>
            <h2>Avalaible account balance: {{ $account->currency }} {{ sprintf("%.2f", $account->amount) }}</h2>
            <a href="{{ route('payment', ['account' => $account]) }}">Make payment</a>
            <div id='recipients' class="block md:flex items-center justify-between">
                <table id="example">
                    <thead>
                        <tr>
                            <th data-priority="1">Transaction ID</th>
                            <th data-priority="2">Type</th>
                            <th data-priority="3">Senders name</th>
                            <th data-priority="4">Senders account</th>
                            <th data-priority="5">Senders account currency</th>
                            <th data-priority="6">Amount</th>
                            <th data-priority="7">Recipients name</th>
                            <th data-priority="8">Recipients account</th>
                            <th data-priority="9">Recipients account currency</th>
                            <th data-priority="10">Date of transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($account->outgoingTransaction as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>@if($loggedUser === $transaction->senders_name)
                                Outgoing payment
                                @elseif($loggedUser == $transaction->recipients_name)
                                Incoming payment
                                @endif</td>
                            <td>{{ $transaction->senders_name }}</td>
                            <td>{{ $transaction->senders_account }}</td>
                            <td>{{ $transaction->senders_account_currency }}</td>
                            <td>{{ sprintf("%.2f", $transaction->amount) }}</td>
                            <td>{{ $transaction->recipients_name }}</td>
                            <td>{{ $transaction->recipients_account }}</td>
                            <td>{{ $transaction->recipients_account_currency }}</td>
                            <td>{{ $transaction->created_at }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.4/b-flash-1.6.4/b-html5-1.6.4/b-print-1.6.4/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                let table = $('#example').DataTable({
                    responsive: true
                    , dom: 'Blfrtip'
                }).columns.adjust().responsive.recalc();
            });

        </script>
    </x-app-layout>

</body>
</html>
