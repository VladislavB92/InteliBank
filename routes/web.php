<?php

use Illuminate\Support\Facades\Route;

Route::resource('accounts', 'AccountsController')
    ->middleware(['auth']);

Route::resource('transactions', 'TransactionsController')
    ->middleware(['auth']);

Route::get('/accounts', function () {
    return view('all');
})->middleware('auth');

Route::redirect('/', 'accounts');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/accounts', 'AccountsController@index')
    ->middleware('auth')
    ->name('all');

Route::get('/accounts/{account:account_number}', 'AccountsController@show')
    ->middleware('auth')
    ->name('details');

Route::get('/accounts/{account:account_number}/payment', 'AccountsController@edit')
    ->middleware('auth')
    ->name('payment');

Route::post('/accounts/{account:account_number}/payment/confirmation', 'AccountsController@collectTransactionData')
    ->middleware('auth')
    ->name('confirmation');
