<?php

namespace App\Livewire\Rekap;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

use function PHPUnit\Framework\isEmpty;

class RekonDetail extends Component
{
    #[Title('Detail Rekon')]

    public $rekon;
    public $totalPenerimaan = 0;
    public $totalPengeluaran = 0;
    public function mount($tanggal)
    {
        $this->rekon = DB::table('rekon')->where('tanggal', $tanggal)->get();
        if ($this->rekon->isEmpty()) {
            $this->dispatch('notif', message: 'Data tidak ditemukan', type: 'error', title: 'Gagal');
        }

        $this->totalPenerimaan = $this->rekon->sum('penerimaan');
        $this->totalPengeluaran = $this->rekon->sum('pengeluaran');
    }
    public function render()
    {
        return view('livewire.rekap.rekon-detail');
    }
}
