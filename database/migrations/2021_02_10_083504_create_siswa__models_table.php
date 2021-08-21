<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->bigIncrements('id_siswa');
            $table->string('ta');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nama_siswa');
            $table->string('gender_siswa');
            $table->string('nohp_siswa');
            $table->string('tempat_lahir_siswa');
            $table->date('tanggal_lahir_siswa');
            $table->string('alamat_siswa');
            $table->string('foto_siswa');
            $table->integer('status_daftar');
            $table->integer('id_kelas')->nullable();
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
        Schema::dropIfExists('tb_siswa');
    }
}
