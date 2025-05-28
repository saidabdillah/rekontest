<?php

namespace App\Imports;

use App\Models\TbRegSpb;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class RegSpbImport implements ToCollection, WithHeadingRow, WithMultipleSheets, ShouldQueue, WithChunkReading
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
        try {
            if (isset($rows)) TbRegSpb::truncate();

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
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
