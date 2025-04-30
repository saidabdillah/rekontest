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
        Schema::create('table1s', function (Blueprint $table) {
            $table->id();
            $table->string('hal');
            $table->string('urut');
            $table->date('tanggal');
            $table->string('kode_transaksi');
            $table->string('penerimaan');
            $table->string('pengeluaran');
            $table->text('uraian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table1s');
    }
};
