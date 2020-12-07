<?php

use Illuminate\Support\Facades\Route;

// middleware sets homepage as a login screen
Route::get('/your_cabinet', function () {
    return view('welcome');
})->middleware('auth');


Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');


