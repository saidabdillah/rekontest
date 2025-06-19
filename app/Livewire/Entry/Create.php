<?php

namespace App\Livewire\Entry;

use App\Imports\BkubudImport;
use App\Imports\RegSp2dImport;
use App\Imports\RegSpbImport;
use App\Imports\RekonImport;
use App\Imports\SaldoAwalImport;
use App\Imports\SubUnitImport;
use App\Imports\TarikDataKkImport;
use App\Imports\tbDataImport;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $skpd;
    public $rekon;
    public $bkubud;
    public $sub_unit;
    public $reg_sp2d;
    public $reg_spb;
    public $tb_data;
    public $tb_saldo_awal;

    public function render()
    {
        return view('livewire.entry.create');
    }

    public function uploadTbSaldoAwal()
    {
        try {
            $this->validate([
                'tb_saldo_awal' => 'required|mimes:xlsx,xls',
            ], [
                'tb_saldo_awal.required' => 'File tidak boleh kosong.',
                'tb_saldo_awal.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new SaldoAwalImport, $this->tb_saldo_awal);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {

            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadTbData()
    {
        try {
            $this->validate([
                'tb_data' => 'required|mimes:xlsx,xls',
            ], [
                'tb_data.required' => 'File tidak boleh kosong.',
                'tb_data.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new tbDataImport, $this->tb_data);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadRekon()
    {
        try {
            $this->validate([
                'rekon' => 'required|mimes:xlsx,xls',
            ], [
                'rekon.required' => 'File tidak boleh kosong.',
                'rekon.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new RekonImport, $this->rekon);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Error!')
                ->error()
                ->show();
        }
    }

    public function uploadSkpd()
    {
        try {
            $this->validate([
                'skpd' => 'required|mimes:xlsx,xls',
            ], [
                'skpd.required' => 'File tidak boleh kosong.',
                'skpd.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new TarikDataKkImport, $this->skpd);
            $this->reset();
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadBKUBUD()
    {
        try {
            $this->validate([
                'bkubud' => 'required|mimes:xlsx,xls',
            ], [
                'bkubud.required' => 'File tidak boleh kosong.',
                'bkubud.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new BkubudImport, $this->bkubud);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadSubUnit()
    {
        try {
            $this->validate([
                'sub_unit' => 'required|mimes:xlsx,xls',
            ], [
                'sub_unit.required' => 'File tidak boleh kosong.',
                'sub_unit.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new SubUnitImport, $this->sub_unit);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadRegSp2d()
    {
        try {
            $this->validate([
                'reg_sp2d' => 'required|mimes:xlsx,xls',
            ], [
                'reg_sp2d.required' => 'File tidak boleh kosong.',
                'reg_sp2d.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new RegSp2dImport, $this->reg_sp2d);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function uploadRegSpb()
    {
        try {
            $this->validate([
                'reg_spb' => 'required|mimes:xlsx,xls',
            ], [
                'reg_spb.required' => 'File tidak boleh kosong.',
                'reg_spb.mimes' => 'File harus berupa xlsx, atau xls.',
            ]);
            Excel::import(new RegSpbImport, $this->reg_spb);
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
            $this->reset();
        } catch (\Throwable $e) {
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }
}
