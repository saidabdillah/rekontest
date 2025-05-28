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
            ->join('tb_sub_unit', 'tb_sub_unit.kd_sub_unit', '=', 'tarik_data_kk.kd_skpd')
            ->select([
                'tb_sub_unit.kd_sub_unit',
                'tb_sub_unit.nm_sub_unit',
                DB::raw('SUM(COALESCE(tarik_data_kk.pagu_anggaran, 0)) AS total_anggaran'),
                DB::raw('SUM(COALESCE(tarik_data_kk.ls, 0) + COALESCE(tarik_data_kk.up_gu_tu, 0)) AS realisasi'),
                DB::raw('SUM(COALESCE(tarik_data_kk.pagu_anggaran, 0)) - 
                SUM(COALESCE(tarik_data_kk.ls, 0) + COALESCE(tarik_data_kk.up_gu_tu, 0)) AS selisih'),
                DB::raw('ROUND(
                CASE 
                    WHEN SUM(COALESCE(tarik_data_kk.pagu_anggaran, 0)) = 0 THEN 0
                    ELSE SUM(COALESCE(tarik_data_kk.ls, 0) + COALESCE(tarik_data_kk.up_gu_tu, 0)) / 
                         SUM(COALESCE(tarik_data_kk.pagu_anggaran, 0)) * 100
                END, 2) AS persentase')
            ])
            ->groupBy('tb_sub_unit.kd_sub_unit', 'tb_sub_unit.nm_sub_unit')
            ->orderByDesc('tb_sub_unit.created_at')
            ->get();

        $this->total_anggaran = $this->data->sum('total_anggaran');
        $this->realisasi = $this->data->sum('realisasi');
        $this->selisih = $this->total_anggaran - $this->realisasi;

        $this->persentase = $this->total_anggaran > 0
            ? round(($this->realisasi / $this->total_anggaran) * 100, 2)
            : 0;
    }

    public function render()
    {
        return view('livewire.rekap.rekap');
    }
}
