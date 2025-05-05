<?php

namespace App\Imports;

use App\Models\Rekon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RekonImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'TB_REKON' => new RekonImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Rekon::create([
                'hal' => $row['hal'],
                'urut' => $row['urut'],
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'kode_transaksi' => $row['kode_transaksi'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }
}
