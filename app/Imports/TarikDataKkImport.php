<?php

namespace App\Imports;

use App\Models\TarikDataKk;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TarikDataKkImport implements ToCollection, WithMultipleSheets, WithHeadingRow, ShouldQueue, WithChunkReading, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function sheets(): array
    {
        return [
            'TB_TARIK_DATA_KK' => new TarikDataKkImport(),
        ];
    }
    public function collection(Collection $rows)
    {
        $already = TarikDataKk::where('kd_skpd', $rows[0]['kd_skpd'])->first();
        if ($already) {
            foreach ($rows as $row) {
                TarikDataKk::where('kd_skpd', $row['kd_skpd'])->update([
                    'versi' => $row['versi'],
                    'kd_skpd' => $row['kd_skpd'],
                    'kd_program' => $row['kd_program'],
                    'nm_program' => $row['nm_program'],
                    'kd_kegiatan' => $row['kd_kegiatan'],
                    'nm_kegiatan' => $row['nm_kegiatan'],
                    'kd_sub_kegiatan' => $row['kd_sub_kegiatan'],
                    'nm_sub_kegiatan' => $row['nm_sub_kegiatan'],
                    'aktivitas' => $row['aktivitas'],
                    'kd_rekening' => $row['kd_rekening'],
                    'nm_rekening' => $row['nm_rekening'],
                    'pagu_anggaran' => $row['pagu_anggaran'],
                    'tgl_bukti' => $row['tgl_bukti'],
                    'no_bukti' => $row['no_bukti'],
                    'uraian' => $row['uraian'],
                    'ls' => $row['ls'],
                    'up_gu_tu' => $row['up_gu_tu'],
                    'no_lpj' => $row['no_lpj'],
                    'no_lpj_bp' => $row['no_lpj_bp'],
                    'no_spp' => $row['no_spp'],
                    'no_spm' => $row['no_spm'],
                    'tgl_sp2d' => $row['tgl_sp2d'],
                    'no_sp2d' => $row['no_sp2d'],
                    'pengembalian' => $row['pengembalian'],
                    'koreksi' => $row['koreksi'],
                    'bulan' => $row['bulan'],
                    'pilih_nihil' => $row['pilih_nihil'],
                    'nilai_pengembalian_nihil' => $row['nilai_pengembalian_nihil']
                ]);
            }
        } else {
            foreach ($rows as $row) {
                TarikDataKk::create([
                    'versi' => $row['versi'],
                    'kd_skpd' => $row['kd_skpd'],
                    'kd_program' => $row['kd_program'],
                    'nm_program' => $row['nm_program'],
                    'kd_kegiatan' => $row['kd_kegiatan'],
                    'nm_kegiatan' => $row['nm_kegiatan'],
                    'kd_sub_kegiatan' => $row['kd_sub_kegiatan'],
                    'nm_sub_kegiatan' => $row['nm_sub_kegiatan'],
                    'aktivitas' => $row['aktivitas'],
                    'kd_rekening' => $row['kd_rekening'],
                    'nm_rekening' => $row['nm_rekening'],
                    'pagu_anggaran' => $row['pagu_anggaran'],
                    'tgl_bukti' => $row['tgl_bukti'],
                    'no_bukti' => $row['no_bukti'],
                    'uraian' => $row['uraian'],
                    'ls' => $row['ls'],
                    'up_gu_tu' => $row['up_gu_tu'],
                    'no_lpj' => $row['no_lpj'],
                    'no_lpj_bp' => $row['no_lpj_bp'],
                    'no_spp' => $row['no_spp'],
                    'no_spm' => $row['no_spm'],
                    'tgl_sp2d' => $row['tgl_sp2d'],
                    'no_sp2d' => $row['no_sp2d'],
                    'pengembalian' => $row['pengembalian'],
                    'koreksi' => $row['koreksi'],
                    'bulan' => $row['bulan'],
                    'pilih_nihil' => $row['pilih_nihil'],
                    'nilai_pengembalian_nihil' => $row['nilai_pengembalian_nihil'],
                ]);
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
