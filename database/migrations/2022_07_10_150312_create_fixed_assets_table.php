<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jemaat_id')->nullable()->unsigned();
            $table->bigInteger('jenis_fixed_id')->nullable()->unsigned();
            $table->string('status_kepemilikan')->nullable();
            $table->string('terbit_oleh')->nullable();
            $table->string('no_imb')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('nama_bangunan')->nullable();
            $table->string('posisi_surat')->nullable();
            $table->string('pihak_ke3')->nullable();
            $table->string('manfaat_untuk')->nullable();
            $table->text('lok_fisik_bangunan')->nullable();
            $table->text('ket_sertifikat')->nullable();
            $table->date('tgl_sertifikat')->nullable();
            $table->date('tgl_expired')->nullable();
            $table->date('tgl_imb')->nullable();
            $table->date('tgl_ke_konfrens')->nullable();
            $table->date('tgl_mulai_kerjasama')->nullable();
            $table->date('tgl_akhir_kerjasama')->nullable();
            $table->string('flag_active')->nullable();
            $table->foreign('jemaat_id')->references('id')->on('jemaats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jenis_fixed_id')->references('id')->on('jenis_fixed_assets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fixed_assets');
    }
};
