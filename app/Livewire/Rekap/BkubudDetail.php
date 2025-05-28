<?php

namespace App\Livewire\Rekap;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class BkubudDetail extends Component
{
    #[Title('Detail BKUBUD')]

    public $bkubud;
    public $totalPenerimaan = 0;
    public $totalPengeluaran = 0;

    public function mount($tanggal)
    {
        $this->bkubud = DB::table('bkubud')->where('tanggal', $tanggal)->get();
        if ($this->bkubud->isEmpty()) {
            $this->dispatch('notif', message: 'Data tidak ditemukan', type: 'error', title: 'Gagal');
        }

        $this->totalPenerimaan = $this->bkubud->sum('penerimaan');
        $this->totalPengeluaran = $this->bkubud->sum('pengeluaran');
    }
    public function render()
    {
        return view('livewire.rekap.bkubud-detail');
    }
}
