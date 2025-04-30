<?php

namespace App\Livewire\Entry;

use App\Models\Mahasiswa;
use Livewire\Component;

class View extends Component
{
    public $date, $kode, $bukti;
    public function render()
    {
        $mahasiswa = Mahasiswa::all();
        return view('livewire.entry.view', [
            'students' => [],
        ]);
    }

    public function search()
    {
        dd($this->date);
    }
}
