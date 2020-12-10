<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Transaction $transaction)
    {
       // $transaction = (new Transaction)->fill($request->all());
       sleep(2);
        return view('user.account.details');
        
    }

    public function show()
    {
        return view('user.account.confirmation');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
