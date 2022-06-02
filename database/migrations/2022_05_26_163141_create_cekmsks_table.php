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
        Schema::create('cekmsks', function (Blueprint $table) {
            $table->id();
            $table->string('kasmsk');
            $table->string('baris');
            $table->string('kas');
            $table->string('giro');
            $table->string('tglcair');
            $table->string('cur');
            $table->float('nil');
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
        Schema::dropIfExists('cekmsks');
    }
};
