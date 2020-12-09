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
        $transaction = (new Transaction)->fill($request->all());

        
    }

    public function show($id)
    {
        //
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
