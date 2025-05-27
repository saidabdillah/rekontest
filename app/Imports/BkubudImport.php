<?php

namespace App\Imports;

use App\Models\Bkubud;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BkubudImport implements ToCollection, WithHeadingRow, WithMultipleSheets, ShouldQueue, WithChunkReading
{
    public function sheets(): array
    {
        return [
            'TB_BKU_BUD' => new BkubudImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) Bkubud::truncate();

        foreach ($rows as $row) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
            Bkubud::create([
                'tanggal' => $tanggal,
                'no_bukti' => $row['no_bukti'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
