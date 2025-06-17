<?php

namespace App\Livewire\Rekap;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Rekon extends Component
{
    public $currentYear;
    public $currentMonth;
    public $kalender = [];
    public $rekonData = [];
    public $detailTanggal = null;
    public $detailData = [];

    public function mount()
    {
        $this->currentYear = Carbon::now()->year;
        $this->currentMonth = Carbon::now()->month;
        $this->generateKalender();
        $this->loadRekonData();
    }

    public function generateKalender()
    {
        $startOfMonth = Carbon::create($this->currentYear, $this->currentMonth, 1)->startOfMonth();
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $this->kalender = [];
        while ($startOfMonth <= $endOfMonth) {
            $this->kalender[] = [
                'tanggal' => $startOfMonth->format('d'),
                'tanggal_penuh' => $startOfMonth->format('Y-m-d'),
            ];
            $startOfMonth->addDay();
        }
    }

    public function loadRekonData()
    {
        $data = DB::table('rekon')
            ->whereYear('tanggal', $this->currentYear)
            ->whereMonth('tanggal', $this->currentMonth)
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('Y-m-d');
            });

        $this->rekonData = $data;
    }

    public function previousMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentYear = $date->year;
        $this->currentMonth = $date->month;
        $this->generateKalender();
        $this->loadRekonData();
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentYear = $date->year;
        $this->currentMonth = $date->month;
        $this->generateKalender();
        $this->loadRekonData();
    }

    public function showDetail($tanggalPenuh)
    {
        $this->detailTanggal = $tanggalPenuh;
        $this->detailData = DB::table('rekon')
            ->whereDate('tanggal', $tanggalPenuh)
            ->get();
    }

    public function render()
    {
        return view('livewire.rekap.rekon');
    }
}
