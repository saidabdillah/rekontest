<?php

namespace App\Livewire\Entry;

use App\Imports\MahasiswaImport;
use App\Imports\table1Import;
use App\Imports\table2Import;
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
        $validate = $this->validate([
            'excelFile1' => 'required|mimes:xlsx,csv,xls|max:2048',
        ], [
            'excelFile1.required' => 'File tidak boleh kosong.',
            'excelFile1.mimes' => 'File harus berupa xlsx, csv, atau xls.',
            'excelFile1.max' => 'Ukuran file maksimal 2 MB.',
        ]);

        Excel::import(new table1Import(), $this->excelFile1);
        session()->flash('status', 'Data Berhasil Diupload');
        return redirect()->route('entry.index');
    }

    public function simpanFileExcel2()
    {
        $this->validate([
            'excelFile2' => 'required|mimes:xlsx,csv,xls|max:2048',
        ]);
        Excel::import(new table2Import(), $this->excelFile2);
        session()->flash('status', 'Data Berhasil Diupload');
        return redirect()->route('entry.index');
    }
}
