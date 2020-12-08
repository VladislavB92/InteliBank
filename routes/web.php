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
    ->name('all');

Route::get('/accounts/{account:account_number}', 'AccountsController@show')
    ->name('details');

