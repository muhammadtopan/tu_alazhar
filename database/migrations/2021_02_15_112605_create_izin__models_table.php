<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIzinModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_izin', function (Blueprint $table) {
            $table->bigIncrements('id_izin');
            $table->integer('id_siswa');
            $table->string('keterangan_izin');
            $table->date('tgl_izin');
            $table->string('foto_izin');
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
        Schema::dropIfExists('tb_izin');
    }
}
