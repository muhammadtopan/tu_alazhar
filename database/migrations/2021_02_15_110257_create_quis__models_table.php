<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuisModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_quis', function (Blueprint $table) {
            $table->bigIncrements('id_quis');
            $table->integer('id_kelas');
            $table->integer('id_pelajaran');
            $table->text('soal');
            $table->text('pil_a');
            $table->text('pil_b');
            $table->text('pil_c');
            $table->text('pil_d');
            $table->text('kunci');
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
        Schema::dropIfExists('tb_quis');
    }
}
