<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKunjungansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id');
            $table->string('keluhan')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('terapi_kie')->nullable();
            $table->string('paraf')->nullable();
            $table->string('status_kunjungan')->nullable();
            $table->string('riwayat_alergi')->nullable();
            $table->timestamp('tgl_kunjungan')->nullable();
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
        Schema::dropIfExists('kunjungans');
    }
}
