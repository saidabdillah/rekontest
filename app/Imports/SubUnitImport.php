<?php

namespace App\Imports;

use App\Models\tb_sub_unit;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubUnitImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function sheets(): array
    {
        return [
            'TB_DATA_SUB_UNIT' => new SubUnitImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        if (isset($rows)) DB::table('tb_sub_unit')->delete();

        foreach ($rows as $row) {
            tb_sub_unit::create([
                "subunit" => $row['subunit'],
                // "kd_sub_unit" => $row['kd_sub'],
                // "nm_sub_unit" => $row['nama_sub_unit'],
                // "nm_bendahara" => $row['nm_bendahara'],
                // "nip_bendahara" => $row['nip_bendahara'],
                // "nm_atasan" => $row['nm_atasan'],
                // "nip_atasan" => $row['nip_atasan'],
                // "jab_atasan" => $row['jab_atasan'],
                // "saldo_awal" => $row['saldo_awal'],
                "jenis" => $row['jenis'],
                // "subbid" => $row['subbid'],
                // "kd_sub_unit_eblud" => $row['kd_sub_unit_eblud'],
                // "nama_sub_unit_eblud" => $row['nama_sub_unit_eblud'],
                // "npsn" => $row['npsn'],
                // "nama_sub_arkas" => $row['nama_sub_arkas'],
            ]);
        }
    }
}
