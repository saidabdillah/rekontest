<?php

namespace App\Livewire\Rekap;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Bkubud extends Component
{
    public $kalender = [];
    public $bkubudData = [];
    public $detailTanggal = null;
    public $detailData = [];
    public $currentMonth;
    public $currentYear;

    public function mount()
    {
        $this->currentMonth = now()->month;
        $this->currentYear = now()->year;
        $this->generateKalender();
        $this->loadBkubudData();
    }

    public function generateKalender()
    {
        $tanggalAwal = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $tanggalAkhir = $tanggalAwal->copy()->endOfMonth();

        $kalender = [];

        while ($tanggalAwal <= $tanggalAkhir) {
            $kalender[] = [
                'tanggal' => $tanggalAwal->format('d'),
                'tanggal_penuh' => $tanggalAwal->format('Y-m-d'),
            ];
            $tanggalAwal->addDay();
        }

        $this->kalender = $kalender;
    }

    public function loadBkubudData()
    {
        $data = DB::table('bkubud')
            ->whereYear('tanggal', $this->currentYear)
            ->whereMonth('tanggal', $this->currentMonth)
            ->get();

        $this->bkubudData = $data->groupBy('tanggal');
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->generateKalender();
        $this->loadBkubudData();
        $this->detailTanggal = null;
        $this->detailData = [];
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentMonth = $date->month;
        $this->currentYear = $date->year;
        $this->generateKalender();
        $this->loadBkubudData();
        $this->detailTanggal = null;
        $this->detailData = [];
    }

    public function showDetail($tanggal)
    {
        $this->detailTanggal = $tanggal;
        $this->detailData = DB::table('bkubud')->where('tanggal', $tanggal)->get();
    }

    public function render()
    {
        return view('livewire.rekap.bkubud');
    }
}
