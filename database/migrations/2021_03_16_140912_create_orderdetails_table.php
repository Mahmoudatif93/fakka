<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('order_year')->default(0);
            $table->integer('orderheaders_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->string('delivery_type')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('product_name')->nullable();
            $table->string('category_name')->nullable();
            $table->double('product_weight')->default(0);
            $table->double('qty')->default(0);
            $table->double('unit_price')->default(0);
            $table->double('fees')->default(0);
            $table->double('total_price')->default(0);
            $table->double('commission')->default(0);
            $table->double('tax')->default(0);
            $table->double('earned_points')->default(0);
            $table->string('recet_no')->nullable();
            $table->string('certificate_no')->nullable();
            $table->integer('purchased')->default(0);

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('orderheaders_id')->references('id')->on('orderheaders')->onDelete('cascade');
         
            
            $table->integer('deleted')->default(0);
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
        Schema::dropIfExists('orderdetails');
    }
}
