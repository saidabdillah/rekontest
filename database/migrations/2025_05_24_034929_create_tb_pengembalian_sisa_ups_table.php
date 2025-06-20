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
        Schema::create('tb_pengembalian_sisa_up', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_bukti');
            $table->text('uraian');
            $table->decimal('nilai', 30, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pengembalian_sisa_up');
    }
};
