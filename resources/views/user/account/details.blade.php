<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details for account ') }}{{ $account->account_number }}
        </h2>
    </x-slot>
</x-app-layout>
