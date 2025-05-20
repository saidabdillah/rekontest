<?php

namespace App\Livewire\Rekap;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Rekap extends Component
{
    public $data, $total_anggaran, $realisasi, $selisih, $persentase;

    public function mount()
    {
        $this->data = DB::table('tarik_data_kk')
            ->select(
                'tb_sub_unit.kd_sub_unit',
                'tb_sub_unit.nm_sub_unit',
                DB::raw('SUM(CAST(tarik_data_kk.pagu_anggaran AS UNSIGNED)) as total_anggaran'),
                DB::raw('SUM(CAST(tarik_data_kk.ls AS UNSIGNED) + CAST(tarik_data_kk.up_gu_tu AS UNSIGNED)) as realisasi'),
                DB::raw('SUM(CAST(tarik_data_kk.pagu_anggaran AS UNSIGNED)) - SUM(CAST(tarik_data_kk.ls AS UNSIGNED) + CAST(tarik_data_kk.up_gu_tu AS UNSIGNED)) as selisih'),
                DB::raw('ROUND(
            SUM(CAST(tarik_data_kk.ls AS UNSIGNED) + CAST(tarik_data_kk.up_gu_tu AS UNSIGNED)) /
            SUM(CAST(tarik_data_kk.pagu_anggaran AS UNSIGNED)) * 100, 2) as persentase')
            )
            ->leftJoin('tb_sub_unit', 'tb_sub_unit.kd_sub_unit', '=', 'tarik_data_kk.kd_skpd')
            ->groupBy('tarik_data_kk.kd_skpd', 'tb_sub_unit.nm_sub_unit')
            ->orderByDesc('tb_sub_unit.created_at')
            ->get();

        foreach ($this->data as $data) {
            $this->total_anggaran += $data->total_anggaran;
            $this->realisasi += $data->realisasi;
            $this->selisih += $data->selisih;
            $this->persentase += $data->persentase;
        }
    }

    public function render()
    {
        return view('livewire.rekap.rekap');
    }
}
