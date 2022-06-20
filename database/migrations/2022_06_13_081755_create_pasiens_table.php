<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm');
            $table->string('nama');
            $table->string('nama_kk');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('hubungan');
            $table->date('tgl_lahir');
            $table->string('umur');
            $table->string('alamat');
            $table->enum('status', ['umum', 'bpjs']);
            $table->string('no_bpjs')->nullable();
            $table->string('riwayat_alergi')->nullable();
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
        Schema::dropIfExists('pasiens');
    }
}
