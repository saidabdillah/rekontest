<?php

namespace App\Imports;

use App\Models\saldoAwal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SaldoAwalImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function sheets(): array
    {
        return [
            'saldo awal' => new SaldoAwalImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('tb_saldo_awal')->delete();

        foreach ($rows as $row) {
            saldoAwal::create([
                'giro' => $row['giro'],
                'deposito' => $row['deposito'],
                'jkn' => $row['jkn'],
                'bok' => $row['bok'],
                'blud' => $row['blud'],
                'bos' => $row['bos'],
                'bop' => $row['bop'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
            ]);
        }
    }
}
