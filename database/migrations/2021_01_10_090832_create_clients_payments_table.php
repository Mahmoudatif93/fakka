<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('orderpayment_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('delivery_type')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('iban')->nullable();
            $table->double('total_price', 50, 2)->nullable();
            $table->string('product_name')->nullable();
            $table->string('category_name')->nullable();
            $table->double('price_per_gram', 50, 2)->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_weight')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('totalQty')->nullable();
            $table->string('paid_at')->nullable();
            $table->integer('deleted')->default(0);
            $table->integer('status')->default(0);
            $table->string('ingot_id')->nullable();
            $table->foreign('orderpayment_id')->references('id')->on('order_payments')->onDelete('cascade');
          //  $table->foreign('ingot_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('clients_payments');
    }
}
