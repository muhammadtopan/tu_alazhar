<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip');
            $table->string('nama_peg');
            $table->integer('jabatan_id');
            $table->string('Email');
            $table->string('no_tlp');
            $table->string('alamat');
            $table->date('tgl_masuk');
            $table->string('tmp_lahir');
            $table->string('agama');
            $table->string('gender');
            $table->string('pendidikan');
            $table->string('foto');
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
        Schema::dropIfExists('tb_pegawai');
    }
}
