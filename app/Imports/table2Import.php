<?php

namespace App\Imports;

use App\Models\table2;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class table2Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new table2([
            'tanggal' => Date::excelToDateTimeObject($row['tanggal']),
            'nomor_bukti' => $row['nomor_bukti'],
            'penerimaan' => $row['penerimaan'],
            'pengeluaran' => $row['pengeluaran'],
            'uraian' => $row['uraian'],
        ]);
    }
}
