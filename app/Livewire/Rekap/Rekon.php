<?php

namespace App\Livewire\Rekap;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Rekon extends Component
{
    public $kalender;
    public $rekon;

    public function render()
    {
        return view('livewire.rekap.rekon');
    }

    public function mount()
    {
        $tahun = Carbon::now()->year;

        $bulanAwal = Carbon::create($tahun, 1, 1);
        $bulanAkhir = Carbon::create($tahun, 12, 31);

        $tanggalAwal = $bulanAwal->copy()->startOfMonth();
        $tanggalAkhir = $bulanAkhir->copy()->endOfMonth();
        $kalender = [];

        while ($tanggalAwal <= $tanggalAkhir) {
            $bulan = $tanggalAwal->locale('id')->translatedFormat('m');

            $kalender[] = [
                'tanggal' => $tanggalAwal->copy()->translatedFormat('d'),
                'bulan' => $bulan,
                'tahun' => $tahun,
            ];

            $tanggalAwal->addDay();
        }

        $this->kalender = $kalender;
    }

    public function show($bulan)
    {
        $this->rekon = DB::table('rekon')->where('tanggal', $bulan)->first();
    }
}
