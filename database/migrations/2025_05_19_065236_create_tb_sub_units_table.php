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
        Schema::create('tb_sub_unit', function (Blueprint $table) {
            $table->id();
            $table->string('subunit');
            // $table->string('kd_sub_unit')->unique();
            // $table->string('nm_sub_unit')->nullable('-');
            // $table->string('nm_bendahara')->nullable('-');
            // $table->string('nip_bendahara')->nullable('-');
            // $table->string('nm_atasan')->nullable('-');
            // $table->string('nip_atasan')->nullable('-');
            // $table->string('jab_atasan')->nullable('-');
            // $table->bigInteger('saldo_awal')->nullable(0);
            $table->string('jenis')->nullable('-');
            // $table->string('subbid')->nullable('-');
            // $table->string('kd_sub_unit_eblud')->nullable('-');
            // $table->string('nama_sub_unit_eblud')->nullable('-');
            // $table->string('npsn')->nullable('-');
            // $table->string('nama_sub_arkas')->nullable('-');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sub_unit');
    }
};
