<?php

namespace App\Imports;

use App\Models\Bkubud;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BkubudImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithMultipleSheets, WithValidation
{
    public function sheets(): array
    {
        return [
            'TB_BKU_BUD' => new BkubudImport(),
        ];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
            Bkubud::create([
                'tanggal' => $tanggal,
                'no_bukti' => $row['no_bukti'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required'],
            'no_bukti' => ['required'],
            'penerimaan' => ['required'],
            'pengeluaran' => ['required'],
            'uraian' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.tanggal.required' => 'Tanggal tidak boleh kosong.',
            '*.no_bukti.required' => 'No bukti tidak boleh kosong.',
            '*.penerimaan.required' => 'Penerimaan tidak boleh kosong.',
            '*.pengeluaran.required' => 'Pengeluaran tidak boleh kosong.',
        ];
    }
}
