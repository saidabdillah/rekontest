<?php

namespace App\Imports;

use App\Models\TbRegSpb;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RegSpbImport implements ToCollection, WithHeadingRow, WithMultipleSheets
{
    /**
     * @param Collection $collection
     */

    public function sheets(): array
    {
        return [
            'TB_REG_SPB' => new RegSpbImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('tb_reg_spb')->delete();

        foreach ($rows as $row) {
            TbRegSpb::create([
                'sub_unit' => $row['subunit'],
                'tanggal' => Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d'),
                'no_spb' => $row['no_spb'],
                'no_sp2b' => $row['no_sp2b'],
                'uraian' => $row['uraian_spb'],
                'pendapatan' => $row['pendapatan'],
                'belanja' => $row['belanja'],
                'jenis' => $row['jenis'],
            ]);
        }
    }
}
