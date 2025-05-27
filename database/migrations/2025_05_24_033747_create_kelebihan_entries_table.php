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
        Schema::create('KELEBIHAN_ENTRY_1', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_kode_transaksi');
            $table->decimal('lebih_entry', 20, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('KELEBIHAN_ENTRY_1');
    }
};
