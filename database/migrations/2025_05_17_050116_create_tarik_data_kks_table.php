<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarik_data_kk', function (Blueprint $table) {
            $table->id();
            $table->string('versi');
            $table->string('kd_skpd');
            $table->string('kd_program');
            $table->string('nm_program');
            $table->string('kd_kegiatan');
            $table->string('nm_kegiatan');
            $table->string('kd_sub_kegiatan');
            $table->string('nm_sub_kegiatan');
            $table->string('aktivitas');
            $table->string('kd_rekening');
            $table->string('nm_rekening');
            $table->string('pagu_anggaran');
            $table->string('tgl_bukti');
            $table->string('no_bukti');
            $table->text('uraian');
            $table->string('ls');
            $table->string('up_gu_tu');
            $table->string('no_lpj');
            $table->string('no_lpj_bp');
            $table->string('no_spp');
            $table->string('no_spm');
            $table->string('tgl_sp2d');
            $table->string('no_sp2d');
            $table->string('pengembalian');
            $table->string('koreksi');
            $table->string('bulan');
            $table->string('pilih_nihil');
            $table->string('nilai_pengembalian_nihil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarik_data_kks');
    }
};
