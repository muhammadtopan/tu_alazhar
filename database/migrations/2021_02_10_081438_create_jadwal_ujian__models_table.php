<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalUjianModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jadwal_ujian', function (Blueprint $table) {
            $table->bigIncrements('id_jadwal_ujian');
            $table->integer('id_jam_ajar');
            $table->integer('id_kelas');
            $table->integer('id_pelajaran');
            $table->integer('id_guru');
            $table->string('hari_jadwal');
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
        Schema::dropIfExists('tb_jadwal_ujian');
    }
}
