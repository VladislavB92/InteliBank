<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome back!') }}
        </h2>

    </x-slot>

    <div class="py-12">
        @foreach($accounts as $account)
        <h2>{{ $account->account_number }}</h2>
        @endforeach
    </div>
</x-app-layout>
