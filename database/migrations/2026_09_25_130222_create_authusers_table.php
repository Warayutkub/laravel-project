<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authusers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',55);
            $table->string('email',55);
            $table->timestamps();
            $table->integer('level')->unsigned();
            $table->foreign('level')->references('id')->on('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authusers');
    }
}
