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
        Schema::create('tb_data', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_kode_transaksi');
            $table->string('tanggal_nomor_bukti');
            $table->string('id_rekon');
            $table->string('kode_transaksi');
            $table->string('nomor_bukti');
            $table->bigInteger('total_rekon');
            $table->bigInteger('total_bukti');
            $table->string('file_path')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data');
    }
};
