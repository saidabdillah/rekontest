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
        Schema::create('tb_reg_spb', function (Blueprint $table) {
            $table->id();
            $table->string('sub_unit');
            $table->date('tanggal');
            $table->string('no_spb');
            $table->string('no_sp2b');
            $table->text('uraian');
            $table->decimal('pendapatan', 20, 2);
            $table->decimal('belanja', 20, 2);
            $table->string('jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_reg_spb');
    }
};
