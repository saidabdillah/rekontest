<?php

namespace App\Livewire\Entry;

use App\Models\table1;
use App\Models\table2;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Index extends Component
{
    public $date, $table1, $table2, $codes = [], $kode_transaksi, $totalKodeTransaksi, $nomorBukti = [], $nomorBuktiSelect, $totalNomorBukti;

    public function cariTanggal()
    {
        $this->kode_transaksi = null;
        $table1 = Table1::where('tanggal', $this->date)->get();
        $this->codes = $table1->pluck('kode_transaksi');
    }

    public function cariKodeTransaksi()
    {
        $this->kode_transaksi = $this->codes[$this->kode_transaksi];
    }

    public function cariEntry()
    {
        try {
            $this->table1 = Table1::where('kode_transaksi', $this->kode_transaksi)->firstOrFail();
            $this->totalKodeTransaksi = $this->table1->penerimaan + $this->table1->pengeluaran;
            $this->nomorBukti = Table2::all()->pluck('nomor_bukti');
            $this->table2 = null;
            $this->modal('view-entry-1')->close();
        } catch (ModelNotFoundException $e) {
            $this->table1 = null;
            $this->modal('view-entry-1')->close();
        }
    }


    public function cariEntry2()
    {
        try {
            $this->table2 = Table2::where('nomor_bukti', $this->nomorBuktiSelect)->firstOrFail();
            $this->totalNomorBukti = $this->table2->penerimaan + $this->table2->pengeluaran;
            $this->modal('view-entry-2')->close();
        } catch (ModelNotFoundException $e) {
            $this->table2 = null;
            $this->modal('view-entry-2')->close();
        }
    }


    public function render()
    {
        return view('livewire.entry.index');
    }
}
