<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_coins', function (Blueprint $table) {
            $table->id();
            $table->integer('coins_id')->unsigned();
            $table->double('fees', 50, 2)->nullable();
            $table->double('cache_back', 50, 2)->nullable();
            $table->foreign('coins_id')->references('id')->on('coins')->onDelete('cascade');
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
        Schema::dropIfExists('fees_coins');
    }
}
