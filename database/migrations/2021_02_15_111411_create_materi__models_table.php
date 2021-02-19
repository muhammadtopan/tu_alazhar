<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMateriModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_materi', function (Blueprint $table) {
            $table->bigIncrements('id_materi');
            $table->integer('id_pelajaran');
            $table->integer('id_kelas');
            $table->string('materi_pelajaran');
            $table->string('nama_pelajaran');
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
        Schema::dropIfExists('tb_materi');
    }
}
