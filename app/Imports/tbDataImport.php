<?php

namespace App\Imports;

use App\Models\TbData;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class tbDataImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function sheets(): array
    {
        return [
            'TB_DATA' => new tbDataImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('tb_data')->delete();


        foreach ($rows as $row) {
            TbData::create([
                'tanggal_kode_transaksi' => $row['tgl_kode_transaksi'],
                'tanggal_nomor_bukti' => $row['tgl_nomor_bukti'],
                'kode_transaksi' => $row['kode_transaksi'],
                'nomor_bukti' => $row['nomor_bukti'],
                'id_rekon' => $row['id_rekon'],
                'total_rekon' => $row['nilai_rekon'],
                'total_bukti' => $row['nilai_bku'],
            ]);
        }
    }
}
