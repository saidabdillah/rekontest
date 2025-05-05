<?php

namespace App\Imports;

use App\Models\Bkubud;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BkubudImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'TB_BKU_BUD' => new RekonImport(),
        ];
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Bkubud::create([
                'name' => $row[0],
            ]);
        }
    }
}
