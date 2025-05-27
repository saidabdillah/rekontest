<?php

namespace App\Imports;

use App\Models\Rekon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RekonImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading, WithBatchInserts
{
    public function sheets(): array
    {
        return [
            'TB_REKON' => new RekonImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) Rekon::truncate();

        foreach ($rows as $row) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
            $id_rekon = $row['kode_transaksi'] . '-' .  $tanggal . '-' . $row['penerimaan'] . '-' . $row['pengeluaran'];
            Rekon::create([
                'id_rekon' => $id_rekon,
                'hal' => $row['hal'],
                'urut' => $row['urut'],
                'tanggal' => $tanggal,
                'kode_transaksi' => $row['kode_transaksi'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
