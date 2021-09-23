<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_details', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('currency')->default('EGP');
            $table->string('karat')->default('24K');
            $table->double('quantity', 50, 2)->default(0);
            $table->double('total_quantity', 50, 2)->default(0);
            $table->double('total_quantity2', 50, 2)->default(0);
            $table->double('price', 50, 2)->default(0);
            $table->double('commission')->default(0);
            $table->double('total_price')->default(0);
            $table->string('Phone')->nullable();
            $table->string('email')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('status')->default(0);
            $table->integer('paid')->default(0);
            $table->string('iban')->nullable();
            $table->string('recet_no')->nullable();
            $table->string('certificate_no')->nullable();
            $table->DATE('added_at')->nullable();
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
        Schema::dropIfExists('virtual_details');
    }
}
