<?php

namespace App\Imports;

use App\Models\Rekon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class RekonImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'TB_REKON' => new RekonImport(),
        ];
    }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
            $id_rekon = $row['kode_transaksi'] . '-' .  $tanggal . '-' . $row['penerimaan'] . '-' . $row['pengeluaran'];
            Rekon::create([
                'id_rekon' => $id_rekon,
                'hal' => $row['hal'],
                'urut' => $row['urut'],
                'tanggal' => $tanggal,
                'kode_transaksi' => $row['kode_transaksi'],
                'penerimaan' => $row['penerimaan'],
                'pengeluaran' => $row['pengeluaran'],
                'uraian' => $row['uraian'],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'id_rekon' => ['required'],
            'hal' => ['required'],
            'urut' => ['required'],
            'tanggal' => ['required'],
            'kode_transaksi' => ['required'],
            'penerimaan' => ['required'],
            'pengeluaran' => ['required'],
            'uraian' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.id_rekon.required' => 'Id Rekon tidak boleh kosong.',
            '*.hal.required' => 'Hal tidak boleh kosong.',
            '*.urut.required' => 'Urut tidak boleh kosong.',
            '*.tanggal.required' => 'Tanggal tidak boleh kosong.',
            '*.penerimaan.required' => 'Penerimaan tidak boleh kosong.',
            '*.pengeluaran.required' => 'Pengeluaran tidak boleh kosong.',
            '*.uraian.required' => 'Uraian tidak boleh kosong.',
        ];
    }
}
