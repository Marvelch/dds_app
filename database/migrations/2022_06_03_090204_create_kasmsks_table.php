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
        Schema::create('kasmsks', function (Blueprint $table) {
            $table->id();
            $table->string('kasmsk');
            $table->date('tgl');
            $table->string('nobukti');
            $table->string('subket');
            $table->string('ket');
            $table->integer('status');
            $table->integer('lastusr')->nullable();
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
        Schema::dropIfExists('kasmsks');
    }
};
