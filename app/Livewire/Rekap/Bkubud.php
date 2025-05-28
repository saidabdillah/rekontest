<?php

namespace App\Livewire\Rekap;

use Carbon\Carbon;
use Livewire\Component;

class Bkubud extends Component
{
    public $kalender;
    public function render()
    {
        return view('livewire.rekap.bkubud');
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
            $bulan = $tanggalAwal->locale('id')->translatedFormat('d'); // Nama bulan seperti "Januari"
            // $hari = $tanggalAwal->locale('id')->translatedFormat('l'); // Nama hari seperti "Senin"

            $kalender[] = [
                'tanggal' => $tanggalAwal->copy()->translatedFormat('d'),
                'bulan' => $bulan,
                'tahun' => $tahun,
            ];

            $tanggalAwal->addDay();
        }

        $this->kalender = $kalender;
    }
}
