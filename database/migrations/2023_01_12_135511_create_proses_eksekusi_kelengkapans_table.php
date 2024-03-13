<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesEksekusiKelengkapansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_eksekusi_kelengkapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proses_eksekusi_id');
            $table->foreignId('kelengkapan_id');
            $table->string('isi')->nullable();
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
        Schema::dropIfExists('proses_eksekusi_kelengkapans');
    }
}
