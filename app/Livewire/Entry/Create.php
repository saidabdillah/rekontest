<?php

namespace App\Livewire\Entry;

use App\Imports\BkubudImport;
use App\Imports\RegSp2dImport;
use App\Imports\RegSpbImport;
use App\Imports\RekonImport;
use App\Imports\SubUnitImport;
use App\Imports\TarikDataKkImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $skpd;
    public $rekon, $bkubud;
    public $sub_unit;
    public $reg_sp2d;
    public $reg_spb;

    public function render()
    {
        return view('livewire.entry.create');
    }

    public function uploadRekon()
    {
        try {
            $this->validate([
                'rekon' => 'required|mimes:xlsx,xls|max:10024',
            ], [
                'rekon.required' => 'File tidak boleh kosong.',
                'rekon.mimes' => 'File harus berupa xlsx, atau xls.',
                'rekon.max' => 'Ukuran file maksimal 10 MB.',
            ]);
            Excel::queueImport(new RekonImport, $this->rekon);
            $this->dispatch('notif', message: 'Data Rekon Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function uploadSkpd()
    {
        try {
            $this->validate([
                'skpd' => 'required|max:10024',
            ], [
                'skpd.required' => 'File tidak boleh kosong.',
                'skpd.max' => 'Ukuran file maksimal 10 MB.',
            ]);
            Excel::queueImport(new TarikDataKkImport, $this->skpd);
            $this->reset();
            $this->dispatch('notif', message: 'Berhasil Diupload', type: 'success', title: 'Berhasil');
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function uploadBKUBUD()
    {
        try {
            $this->validate([
                'bkubud' => 'required|mimes:xlsx,xls|max:2048',
            ], [
                'bkubud.required' => 'File tidak boleh kosong.',
                'bkubud.mimes' => 'File harus berupa xlsx, atau xls.',
                'bkubud.max' => 'Ukuran file maksimal 2 MB.',
            ]);
            Excel::queueImport(new BkubudImport, $this->bkubud);
            $this->dispatch('notif', message: 'Data BKUBUD Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function uploadSubUnit()
    {
        try {
            $this->validate([
                'sub_unit' => 'required|mimes:xlsx,xls|max:2048',
            ], [
                'sub_unit.required' => 'File tidak boleh kosong.',
                'sub_unit.mimes' => 'File harus berupa xlsx, atau xls.',
                'sub_unit.max' => 'Ukuran file maksimal 2 MB.',
            ]);
            Excel::queueImport(new SubUnitImport, $this->sub_unit);
            $this->dispatch('notif', message: 'Data Sub Unit Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function uploadRegSp2d()
    {
        try {
            $this->validate([
                'reg_sp2d' => 'required|mimes:xlsx,xls|max:2048',
            ], [
                'reg_sp2d.required' => 'File tidak boleh kosong.',
                'reg_sp2d.mimes' => 'File harus berupa xlsx, atau xls.',
                'reg_sp2d.max' => 'Ukuran file maksimal 2 MB.',
            ]);
            Excel::queueImport(new RegSp2dImport, $this->reg_sp2d);
            $this->dispatch('notif', message: 'Data Reg SP2D Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function uploadRegSpb()
    {
        try {
            $this->validate([
                'reg_spb' => 'required|mimes:xlsx,xls|max:2048',
            ], [
                'reg_spb.required' => 'File tidak boleh kosong.',
                'reg_spb.mimes' => 'File harus berupa xlsx, atau xls.',
                'reg_spb.max' => 'Ukuran file maksimal 2 MB.',
            ]);
            Excel::queueImport(new RegSpbImport, $this->reg_spb);
            $this->dispatch('notif', message: 'Data Reg SPB Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }
}
