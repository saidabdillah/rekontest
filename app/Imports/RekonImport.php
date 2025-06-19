<?php

namespace App\Imports;

use App\Models\Rekon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RekonImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'TB_REKON' => new RekonImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('rekon')->delete();

        foreach ($rows as $row) {
            Rekon::create([
                'id_rekon' => $row['id_rekon'],
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
