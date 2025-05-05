<?php

namespace App\Livewire\Entry;

use App\Imports\BkubudImport;
use App\Imports\RekonImport;
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
        $this->validate([
            'rekon' => 'required|mimes:xlsx,csv,xls|max:2048',
        ], [
            'rekon.required' => 'File tidak boleh kosong.',
            'rekon.mimes' => 'File harus berupa xlsx, csv, atau xls.',
            'rekon.max' => 'Ukuran file maksimal 2 MB.',
        ]);

        Rekon::truncate();
        Excel::import(new RekonImport(), $this->rekon);
        session()->flash('status', 'Data Rekon Berhasil Diupload');
        return redirect()->route('entry.index');
    }

    public function uploadBKUBUD()
    {
        $this->validate([
            'bkubud' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);
        Excel::import(new BkubudImport(), $this->bkubud);
        session()->flash('status', 'Data BKUBUD Berhasil Diupload');
        return redirect()->route('entry.index');
    }
}
