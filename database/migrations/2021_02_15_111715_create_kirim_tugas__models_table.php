<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKirimTugasModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kirim_tugas', function (Blueprint $table) {
            $table->bigIncrements('id_kirim_tugas');
            $table->integer('id_tugas');
            $table->integer('id_user');
            $table->date('tgl_kirim_tugas');
            $table->string('file_tugas');
            $table->string('ket_tugas');
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
        Schema::dropIfExists('tb_kirim_tugas');
    }
}
