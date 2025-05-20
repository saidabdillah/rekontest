<?php

namespace Database\Seeders;

use App\Models\tb_sub_unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TbSubUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            [
                'kd_sub_unit' => '01.02.01.00.001',
                'nm_sub_unit' => 'Rumah Sakit Umum Daerah Datu Kandang Haji',
            ],
            [
                'kd_sub_unit' => '01.02.01.00.000',
                'nm_sub_unit' => 'Dinas Kesehatan',
            ],
            [
                'kd_sub_unit' => '01.05.02.00.000',
                'nm_sub_unit' => 'Badan Penanggulangan Bencana Daerah',
            ],
            [
                'kd_sub_unit' => '01.01.01.00.000',
                'nm_sub_unit' => 'Dinas Pendidikan dan Kebudayaan',
            ],
            [
                'kd_sub_unit' => '01.06.01.00.000',
                'nm_sub_unit' => 'Dinas Sosial',
            ],
            [
                'kd_sub_unit' => '02.08.01.00.000',
                'nm_sub_unit' => 'Dinas Pemberdayaan Perempuan dan Perlindungan  Anak, Pengendalian Penduduk dan Keluarga  Berencana Serta Pemberdayaan Masyarakat dan Desa',
            ],
            [
                'kd_sub_unit' => '02.09.01.00.000',
                'nm_sub_unit' => 'Dinas Ketahanan Pangan, Pertanian  dan Perikanan',
            ],
        ];

        foreach ($data as $d) {
            tb_sub_unit::create([
                'kd_sub_unit' => $d['kd_sub_unit'],
                'nm_sub_unit' => $d['nm_sub_unit'],
            ]);
        }
    }
}
