<?php

namespace Database\Seeders;

use App\Models\saldoAwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaldoAwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        saldoAwal::create([
            'giro' => 629401707659.9900,
            'deposito' => 0,
            'jkn' => 21841033.0000,
            'bok' => 2552676313.0000,
            'blud' => 13733779326.8800,
            'bos' => 241939226.0000,
            'bop' => 0,
            'penerimaan' => 0,
            'pengeluaran' => 0,
        ]);
    }
}
