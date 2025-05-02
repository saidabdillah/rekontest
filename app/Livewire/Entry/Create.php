<?php

namespace App\Livewire\Entry;

use App\Imports\MahasiswaImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Create extends Component
{
    use WithFileUploads;
    public $excelFile1, $excelFile2;
    public function render()
    {
        return view('livewire.entry.create');
    }

    public function simpanFileExcel1()
    {
        $this->validate([
            'excelFile1' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);
        Excel::import(new MahasiswaImport(), $this->excelFile1);
        session()->flash('status', 'Data Berhasil Diupload');
        return redirect()->route('entry.view');
    }

    public function simpanFileExcel2()
    {
        $this->validate([
            'excelFile2' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);
        Excel::import(new MahasiswaImport(), $this->excelFile2);
        session()->flash('status', 'Data Berhasil Diupload');
        return redirect()->route('entry.view');
    }
}
