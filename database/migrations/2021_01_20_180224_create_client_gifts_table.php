<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientGiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_gifts', function (Blueprint $table) {
            $table->id();
            $table->integer('gift_id')->unsigned();
            $table->string('client_email')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('approved')->default(0);
            $table->foreign('gift_id')->references('id')->on('gifts')->onDelete('cascade');
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
        Schema::dropIfExists('client_gifts');
    }
}
