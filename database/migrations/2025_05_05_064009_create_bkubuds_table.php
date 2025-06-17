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
        Schema::create('bkubud', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('no_bukti');
            $table->text('uraian');
            $table->decimal('penerimaan', 20, 2);
            $table->decimal('pengeluaran', 20, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkubud');
    }
};
