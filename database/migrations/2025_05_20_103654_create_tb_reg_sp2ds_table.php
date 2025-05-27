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
        Schema::create('tb_reg_sp2d', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_sp2d');
            $table->string('jenis');
            $table->string('sub_unit');
            $table->string('nama_penerima');
            $table->text('keterangan');
            $table->bigInteger('bruto');
            $table->bigInteger('potongan');
            $table->bigInteger('netto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_reg_sp2d');
    }
};
