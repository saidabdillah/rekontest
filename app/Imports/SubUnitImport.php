<?php

namespace App\Imports;

use App\Models\tb_sub_unit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubUnitImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new tb_sub_unit([
            "kd_sub_unit" => $row['kd_sub'],
            "nm_sub_unit" => $row['nama_sub_unit'],
            "nm_bendahara" => $row['nm_bendahara'],
            "nip_bendahara" => $row['nip_bendahara'],
            "nm_atasan" => $row['nm_atasan'],
            "nip_atasan" => $row['nip_atasan'],
            "jab_atasan" => $row['jab_atasan'],
            "saldo_awal" => $row['saldo_awal'],
            "jenis" => $row['jenis'],
            "subbid" => $row['subbid'],
            "kd_sub_unit_eblud" => $row['kd_sub_unit_eblud'],
            "nama_sub_unit_eblud" => $row['nama_sub_unit_eblud'],
            "npsn" => $row['npsn'],
            "nama_sub_arkas" => $row['nama_sub_arkas'],
        ]);
    }
}
