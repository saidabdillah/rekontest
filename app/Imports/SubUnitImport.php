<?php

namespace App\Imports;

use App\Models\tb_sub_unit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubUnitImport implements ToCollection, WithHeadingRow, ShouldQueue, WithChunkReading
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
        if (isset($rows)) tb_sub_unit::truncate();

        foreach ($rows as $row) {
            tb_sub_unit::create([
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

    public function chunkSize(): int
    {
        return 1000;
    }
}
