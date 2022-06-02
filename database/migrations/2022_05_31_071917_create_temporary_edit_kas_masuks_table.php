<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_edit_kas_masuks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users')->nullable();
            $table->foreign('id_users')->references('id')->on('users');
            // $table->unsignedBigInteger('id_kasmsk')->nullable();
            // $table->foreign('id_kasmsk')->references('id')->on('kasmsk1');
            $table->bigInteger('id_opponent');
            $table->string('table_name');
            $table->string('name_opponent');
            $table->string('no_ref');
            $table->string('currency');
            $table->bigInteger('value');
            $table->string('description');
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
        Schema::dropIfExists('temporary_edit_kas_masuks');
    }
};
