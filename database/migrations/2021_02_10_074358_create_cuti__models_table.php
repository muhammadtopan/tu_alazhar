<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCutiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_cuti', function (Blueprint $table) {
            $table->bigIncrements('id_cuti');
            $table->string('nip');
            $table->integer('lama_cuti');
            $table->string('alasan_cuti');
            $table->date('tanggal_mulai');
            $table->date('tanggal_akhir');
            $table->date('tanggal');
            $table->date('tanggal_acc');
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
        Schema::dropIfExists('tb_cuti');
    }
}
