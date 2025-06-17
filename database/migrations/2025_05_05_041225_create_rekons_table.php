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
        Schema::create('rekon', function (Blueprint $table) {
            $table->id();
            $table->string('id_rekon');
            $table->string('hal');
            $table->string('urut');
            $table->date('tanggal');
            $table->string('kode_transaksi');
            $table->decimal('penerimaan', 20, 2);
            $table->decimal('pengeluaran', 20, 2);
            $table->text('uraian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekon');
    }
};
