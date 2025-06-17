<?php

namespace App\Imports;

use App\Models\Bkubud;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BkubudImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'TB_BKU_BUD' => new BkubudImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('bkubud')->delete();

        foreach ($rows as $row) {
            Bkubud::create([
                'tanggal' => $row['tanggal'],
                'no_bukti' => $row['no_bukti'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }
}
