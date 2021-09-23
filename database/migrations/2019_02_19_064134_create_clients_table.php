<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('password');
          $table->string('image')->default('default.png');
            $table->string('email');
            $table->string('national_id');
            $table->string('national_id_front_img');
            $table->string('national_id_back_img');
            $table->string('phone');
            
            $table->text('address');
            $table->string('id_image')->default('default.png');
            $table->string('refer_id')->nullable();
            $table->integer('adminapprove')->default(0);
            $table->string('smscode')->nullable();
            $table->integer('smspprove')->default(0);
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
        Schema::dropIfExists('clients');
    }
}
