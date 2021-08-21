<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_berkas', function (Blueprint $table) {
            $table->bigIncrements('id_berkas');
            $table->integer('id_siwa');
            $table->string('berkas_kk');
            $table->string('berkas_akte');
            $table->string('berkas_lapor');
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
        Schema::dropIfExists('tb_berkas');
    }
}
