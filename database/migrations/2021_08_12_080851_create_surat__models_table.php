<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_surat', function (Blueprint $table) {
            $table->bigIncrements('surat_id');
            $table->enum('surat_jenis', ['masuk', 'keluar'])->default('masuk');
            $table->string('surat_nomor');
            $table->date('surat_tanggal');
            $table->string('surat_tujuan');
            $table->string('surat_ket');
            $table->string('surat_file');
            $table->softDeletes();
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
        Schema::dropIfExists('tb_surat');
    }
}
