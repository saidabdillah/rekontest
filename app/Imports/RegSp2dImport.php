<?php

namespace App\Imports;

use App\Models\TbRegSp2d;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class RegSp2dImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param Collection $collection
     */

    public function sheets(): array
    {
        return [
            'TB_REG_SP2D' => new RegSp2dImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('tb_reg_sp2d')->delete();

        foreach ($rows as $row) {
            TbRegSp2d::create([
                'tanggal' => $row['tanggal'],
                'no_sp2d' => $row['no_sp2d'],
                'jenis' => $row['jenis'],
                'sub_unit' => $row['subunit'],
                'nama_penerima' => $row['nama_penerima'],
                'keterangan' => $row['keterangan'],
                'bruto' => $row['bruto'],
                'potongan' => $row['potongan'],
                'netto' => $row['netto'],
            ]);
        }
    }
}
