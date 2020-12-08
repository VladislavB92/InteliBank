<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditAmountFieldInAccount extends Migration
{
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->renameColumn('ammount', 'amount');
        });
    }
}
