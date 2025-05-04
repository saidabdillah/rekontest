<?php

namespace App\Imports;

use App\Models\table1;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class table1Import implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new table1([
            'hal' => $row['hal'],
            'urut' => $row['urut'],
            'tanggal' => Date::excelToDateTimeObject($row['tanggal']),
            'kode_transaksi' => $row['kode_transaksi'],
            'penerimaan' => $row['penerimaan'],
            'pengeluaran' => $row['pengeluaran'],
            'uraian' => $row['uraian'],
        ]);
    }
}
