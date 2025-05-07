<?php

namespace App\Livewire\Entry;

use App\Imports\BkubudImport;
use App\Imports\RekonImport;
use App\Models\Bkubud;
use App\Models\Rekon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $rekon, $bkubud;

    public function render()
    {
        return view('livewire.entry.create');
    }

    public function uploadRekon()
    {
        try {
            $this->validate([
                'rekon' => 'required|mimes:xlsx,xls|max:2048',
            ], [
                'rekon.required' => 'File tidak boleh kosong.',
                'rekon.mimes' => 'File harus berupa xlsx, atau xls.',
                'rekon.max' => 'Ukuran file maksimal 2 MB.',
            ]);
            Rekon::truncate();
            Excel::import(new RekonImport(), $this->rekon);
            return redirect()->route('entry.index')->with([
                'type' => 'success',
                'status' => 'Data Rekon Berhasil Diupload'
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('entry.create')->with([
                'type' => 'error',
                'status' => $th->getMessage()
            ]);
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
            return redirect()->route('entry.index')->with([
                'type' => 'success',
                'status' => 'Data BKUBUD Berhasil Diupload'
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('entry.create')->with([
                'type' => 'error',
                'status' => $th->getMessage(),
            ]);
        }
    }
}
