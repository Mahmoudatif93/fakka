<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shoping_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->double('totalPrice', 50, 2)->nullable();
            $table->integer('qty')->nullable();
            $table->integer('totalQty')->nullable();
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('user_shoping_carts');
    }
}
