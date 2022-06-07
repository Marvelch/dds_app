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
        Schema::create('kasmsk1s', function (Blueprint $table) {
            $table->id();
            $table->string('kasmsk');
            $table->string('baris');
            $table->string('gollawan');
            $table->string('lawan');
            $table->string('ref');
            $table->string('cur');
            $table->float('nil', 30, 2);
            $table->string('ket');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasmsk1s');
    }
};
