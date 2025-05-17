<?php

namespace App\Livewire\Diagram;

use App\Models\Bkubud;
use App\Models\Rekon;
use App\Models\TbData;
use Livewire\Component;

class Apex extends Component
{
    public $totalBkubud = 0;
    public $totalTbDataRekon = 0;
    public $totalTbDataBkubud = 0;
    public $tanggal;
    public $penerimaan = [];

    public function mount(): void
    {
        $this->tanggal = Rekon::orderBy('tanggal', 'asc')->distinct()->pluck('tanggal')->toArray();
        foreach ($this->tanggal as $item) {
            $this->penerimaan[$item] = Rekon::where('tanggal', $item)->sum('penerimaan');
        }

        $this->bkubud = Bkubud::all();
        foreach ($this->bkubud as $item) {
            $this->totalBkubud += $item->penerimaan + $item->pengeluaran;
        }

        $this->totalTbDataRekon = TbData::all()->pluck('total_rekon');
        $this->totalTbDataBkubud = TbData::all()->pluck('total_bukti');
    }

    public function render()
    {
        return view('livewire.diagram.apex');
    }
}
