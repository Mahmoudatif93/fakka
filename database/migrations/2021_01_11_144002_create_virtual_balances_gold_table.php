<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualBalancesGoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_balances_gold', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->unsigned();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->integer('unite_weight')->default(0);
            $table->double('amount', 50, 2)->default(0);
            $table->double('price', 50, 2)->default(1);
            $table->integer('status')->default(0);
            $table->string('recet_no')->nullable();
            $table->string('certificate_no')->nullable();
            $table->double('cache_back')->default(1);
            
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
        Schema::dropIfExists('virtual_balances');
    }
}
