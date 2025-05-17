<?php

namespace App\Livewire\Entry;

use App\Imports\BkubudImport;
use App\Imports\RekonImport;
use App\Imports\TarikDataKkImport;
use App\Models\Bkubud;
use App\Models\Rekon;
use App\Models\TarikDataKk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public array $banyakFile = [];
    public $rekon, $bkubud;

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
            // Rekon::truncate();
            Excel::import(new RekonImport(), $this->rekon);
            $this->dispatch('notif', message: 'Data Rekon Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function test()
    {
        try {
            $this->validate([
                'banyakFile' => 'required|max:10024',
            ], [
                'banyakFile.required' => 'File tidak boleh kosong.',
                'banyakFile.max' => 'Ukuran file maksimal 10 MB.',
            ]);
            // (new UsersImport)->queue('users.xlsx');

            // dd($this->banyakFile);

            // TarikDataKk::where('kd_skpd', '01.02.01.00.001')->delete();
            // TarikDataKk::truncate();
            foreach ($this->banyakFile as $file) {
                Excel::queueImport(new TarikDataKkImport(), $file);
            }
            // $this->reset();
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
            Bkubud::truncate();
            Excel::import(new BkubudImport(), $this->bkubud);
            $this->dispatch('notif', message: 'Data BKUBUD Berhasil Diupload', type: 'success', title: 'Berhasil');
            $this->reset();
        } catch (\Throwable $e) {
            $this->dispatch('notif', message: $e->getMessage(), type: 'error', title: 'Gagal');
        }
    }
}
