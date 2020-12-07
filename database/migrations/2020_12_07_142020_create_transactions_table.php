<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('senders_name');
            $table->string('senders_account');
            $table->string('senders_account_currency');
            $table->float('ammount');
            $table->string('recipients_name');
            $table->string('recipients_account');
            $table->string('recipients_account_currency');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
