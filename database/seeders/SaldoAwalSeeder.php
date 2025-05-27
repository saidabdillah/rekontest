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
            'giro' => 6294017076599900,
            'deposito' => 0,
            'jkn' => 6294017076599900,
            'bok' => 6294017076599900,
            'blud' => 6294017076599900,
            'bos' => 6294017076599900,
            'bop' => 0,
            'penerimaan' => 0,
            'pengeluaran' => 0,
        ]);
    }
}
