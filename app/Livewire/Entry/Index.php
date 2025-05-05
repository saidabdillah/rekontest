<?php

namespace App\Livewire\Entry;

use App\Models\Bkubud;
use App\Models\Rekon;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Index extends Component
{
    public $tanggal, $kodeTransaksi = [], $kode_transaksi, $rekon, $bkubud, $nomorBukti = [], $nomor_bukti, $totalKodeTransaksi = 0, $totalNomorBukti = 0;

    public function cariTanggal()
    {
        $dataRekon = Rekon::where('tanggal', $this->tanggal)->get();
        $this->kodeTransaksi = $dataRekon->pluck('kode_transaksi')->toArray();
    }

    public function cariRekon()
    {
        $this->rekon = Rekon::where('kode_transaksi', $this->kode_transaksi)->first();
        $this->totalKodeTransaksi = $this->rekon->penerimaan + $this->rekon->pengeluaran;
        $this->modal('lihat-rekon')->close();
    }

    public function mount()
    {
        $this->nomorBukti = Bkubud::all()->pluck('no_bukti')->toArray();
    }

    public function cariBkubud()
    {
        $this->bkubud = Bkubud::where('no_bukti', $this->nomor_bukti)->first();
        $this->totalNomorBukti = $this->bkubud->penerimaan + $this->bkubud->pengeluaran;
        $this->modal('lihat-bkubud')->close();
    }

    public function render()
    {
        return view('livewire.entry.index');
    }
}
