<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsWithdrowHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_withdrow_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->double('amount', 50, 2)->default(0);
            $table->string('currency')->default(0);
            $table->string('iban')->default(0);
            $table->string('bank_name')->nullable();
            $table->integer('status')->default(0);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_with_drow_histories');
    }
}
