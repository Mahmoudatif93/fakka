<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->integer('year')->default(0);
            $table->integer('client_id')->unsigned();
            $table->double('amount',50, 2)->default(0);
            $table->integer('orderheaders_id')->unsigned();
            $table->integer('order_year')->unsigned();
            $table->string('iban')->default(0);
            $table->string('bank_name')->nullable();
            $table->string('transaction_number')->nullable();
            $table->integer('status')->default(0);
            $table->integer('deleted')->default(0);
            $table->foreign('orderheaders_id')->references('id')->on('orderheaders')->onDelete('cascade');
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
        Schema::dropIfExists('wallet_transactions');
    }
}
