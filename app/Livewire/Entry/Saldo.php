<?php

namespace App\Livewire\Entry;

use App\Models\saldoAwal;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Saldo extends Component
{
    public $saldo;
    public $giro;
    public $deposito;
    public $jkn;
    public $bok;
    public $bop;
    public $blud;
    public $bos;
    public $penerimaan;
    public $pengeluaran;

    public function mount()
    {
        $this->saldo = saldoAwal::first();
        $this->giro = $this->saldo->giro;
        $this->deposito = $this->saldo->deposito;
        $this->jkn = $this->saldo->jkn;
        $this->bok = $this->saldo->bok;
        $this->bop = $this->saldo->bop;
        $this->blud = $this->saldo->blud;
        $this->bos = $this->saldo->bos;
        $this->penerimaan = $this->saldo->penerimaan;
        $this->pengeluaran = $this->saldo->pengeluaran;
    }

    public function render()
    {
        return view('livewire.entry.saldo');
    }

    public function updateSaldo()
    {
        $validate = $this->validate([
            'deposito' => 'required',
            'giro' => 'required',
            'jkn' => 'required',
            'bok' => 'required',
            'bop' => 'required',
            'blud' => 'required',
            'bos' => 'required',
            'penerimaan' => 'required',
            'pengeluaran' => 'required',
        ]);
        $this->saldo->update($validate);
        $this->reset('deposito', 'giro', 'jkn', 'bok', 'bop', 'blud', 'bos', 'penerimaan', 'pengeluaran');
        $this->modal('tambah-saldo')->close();
        LivewireAlert::title('Berhasil!')
            ->success()
            ->show();
    }
}
