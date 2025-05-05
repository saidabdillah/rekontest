<?php

namespace App\Livewire\Entry;

use App\Models\Rekon;
use App\Models\table2;
use Livewire\Component;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Index extends Component
{
    public $date, $rekon, $table2, $codes = [], $kode_transaksi, $totalKodeTransaksi, $nomorBukti = [], $nomorBuktiSelect, $totalNomorBukti, $isActiveUpload;

    public function cariTanggal()
    {
        $this->kode_transaksi = null;
        $this->rekon = Rekon::where('tanggal', $this->date)->get();
    }

    public function cariEntry()
    {
        try {
            $this->rekon = Rekon::where('kode_transaksi', explode('-', $this->kode_transaksi)[0])->firstOrFail();
            $this->totalKodeTransaksi = $this->table1->penerimaan + $this->table1->pengeluaran;
            // $this->nomorBukti = Table2::all()->pluck('nomor_bukti');
            // $this->table2 = null;
            $this->modal('view-entry-1')->close();
        } catch (ModelNotFoundException $e) {
            $this->rekon = null;
            $this->modal('view-entry-1')->close();
        }
    }


    public function cariEntry2()
    {
        try {
            $this->table2 = Table2::where('nomor_bukti', $this->nomorBuktiSelect)->firstOrFail();
            $this->totalNomorBukti = $this->table2->penerimaan + $this->table2->pengeluaran;
            $this->isActiveUpload = ($this->table2->kode_transaksi == $this->table1->kode_transaksi);
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
