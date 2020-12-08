<?php

use Illuminate\Support\Facades\Route;


// middleware sets homepage as a login screen
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/accounts', 'AccountsController@index')
    ->middleware('auth')
    ->name('all');

Route::get('/accounts/{account:account_number}', 'AccountsController@show')
    ->middleware('auth')
    ->name('details');

Route::get('/accounts/{account:account_number}/transaction_history', function () {
    return view('user.account.transactions_history');
})
    ->middleware('auth')
    ->name('transactions_history');

Route::get('/accounts/{account:account_number}/operations', function () {
    return view('user.account.operations');
})
    ->middleware('auth')
    ->name('operations');
