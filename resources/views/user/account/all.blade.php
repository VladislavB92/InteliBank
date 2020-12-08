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
                {{ __('Welcome back, ') }}{{ auth()->user()->name }}!
            </h2>
        </x-slot>

        <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
            <div id='recipients' class="mt-6 lg:mt-0 rounded shadow bg-white">
                <table id="example">
                    <thead>
                        <tr>
                            <th data-priority="1">Account number</th>
                            <th data-priority="2">Currency</th>
                            <th data-priority="3">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accounts as $account)
                        <tr>
                            <td><a href="{{ route('details', ['account' => $account]) }}">{{ $account->account_number }}</a></td>
                            <td>{{ $account->currency }}</td>
                            <td>{{ $account->amount }}</td>
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
                    , buttons: [
                        'copy', 'excel', 'pdf'
                    ]
                }).columns.adjust().responsive.recalc();
            });

        </script>
    </x-app-layout>

</body>
</html>
