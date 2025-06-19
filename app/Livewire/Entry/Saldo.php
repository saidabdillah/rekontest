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
        $this->giro = $this->saldo->giro ?? 0;
        $this->deposito = $this->saldo->deposito ?? 0;
        $this->jkn = $this->saldo->jkn ?? 0;
        $this->bok = $this->saldo->bok ?? 0;
        $this->bop = $this->saldo->bop ?? 0;
        $this->blud = $this->saldo->blud ?? 0;
        $this->bos = $this->saldo->bos ?? 0;
        $this->penerimaan = $this->saldo->penerimaan ?? 0;
        $this->pengeluaran = $this->saldo->pengeluaran ?? 0;
    }

    public function render()
    {
        return view('livewire.entry.saldo');
    }

    public function editSaldo()
    {
        $validate = $this->validate([
            'giro' => 'required|numeric|decimal:2',
            'deposito' => 'required|numeric|decimal:2',
            'jkn' => 'required|numeric|decimal:2',
            'bok' => 'required|numeric|decimal:2',
            'bop' => 'required|numeric|decimal:2',
            'blud' => 'required|numeric|decimal:2',
            'bos' => 'required|numeric|decimal:2',
            'penerimaan' => 'required|numeric|decimal:2',
            'pengeluaran' => 'required|numeric|decimal:2',
        ], [
            '*.required' => 'Pilih data dulu.',
            '*.numeric' => ':attribute harus angka.',
            '*.decimal' => ':attribute harus angka decimal dan ada 2 angka di belakang koma.',
        ]);

        if ($this->saldo) {
            $this->saldo->update($validate);
        } else {
            saldoAwal::create($validate);
            $this->reset(); // Reset component state
            $this->mount(); // Re-initialize component state
        }

        $this->modal('tambah-saldo')->close();
        LivewireAlert::title('Berhasil!')
            ->success()
            ->show();
    }
}
