<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsInCurrencies extends Migration
{
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->string('bank')->change();
        });
    }
}
