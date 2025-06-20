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
        Schema::create('tb_saldo_awal', function (Blueprint $table) {
            $table->id();
            $table->decimal('giro', 20, 2);
            $table->decimal('deposito', 20, 2);
            $table->decimal('jkn', 20, 2);
            $table->decimal('bok', 20, 2);
            $table->decimal('bop', 20, 2);
            $table->decimal('blud', 20, 2);
            $table->decimal('bos', 20, 2);
            $table->decimal('penerimaan', 20, 2);
            $table->decimal('pengeluaran', 20, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_saldo_awal');
    }
};
