<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderheaders', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable();
            $table->string('type')->nullable();
            $table->integer('client_id')->unsigned();
            $table->double('total_grams')->default(0);
            $table->double('total_fees')->default(0);
            $table->double('total_commission')->default(0);
            $table->double('total_tax')->default(0);
            $table->double('total_price')->default(0);
            $table->double('price_per_gram')->default(0);
            $table->double('total_qty')->default(0);
            $table->string('currency')->nullable();
            $table->string('payment_date')->nullable();
            $table->integer('status')->default(0);
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('orderheaders');
    }
}
