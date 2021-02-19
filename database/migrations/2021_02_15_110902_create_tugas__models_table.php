<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTugasModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tugas', function (Blueprint $table) {
            $table->bigIncrements('id_tugas');
            $table->integer('id_pelajaran');
            $table->integer('id_kelas');
            $table->string('judul_tugas');
            $table->string('isi_tugas');
            $table->string('file_tugas');
            $table->date('deadline_tugas');            
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
        Schema::dropIfExists('tb_tugas');
    }
}
