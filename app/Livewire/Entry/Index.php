<?php

namespace App\Livewire\Entry;

use App\Models\Bkubud;
use App\Models\Rekon;
use App\Models\TbData;
use Exception;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    public $tanggal;
    public $kodeTransaksi = [];
    public $kode_transaksi;
    public $rekon;
    public $bkubud;
    public $bkubuds = [];
    public $nomorBukti = [];
    public $nomor_bukti;
    public $totalKodeTransaksi;
    public $totalNomorBukti;

    public $query = '';
    use WithFileUploads;

    #[Validate('required|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image;


    // #[On('aktif')]
    public function cariBkubuds()
    {
        $this->bkubuds = Bkubud::where('no_bukti', 'like', '%' . $this->query . '%')->get();
        $this->totalNomorBukti = '';
    }

    public function pilihBkubud($bkubud)
    {
        $this->query = $bkubud;
        $this->dispatch('aktif');
    }


    public function cariTanggal()
    {
        $this->kodeTransaksi = Rekon::where('tanggal', $this->tanggal)->get();
    }

    public function cariRekon()
    {
        try {
            $this->rekon = Rekon::where('kode_transaksi', $this->kode_transaksi)->first();
            $this->totalKodeTransaksi = $this->rekon->penerimaan + $this->rekon->pengeluaran;
            $this->modal('lihat-rekon')->close();
        } catch (\Throwable $th) {
            $this->modal('lihat-rekon')->close();
        }
    }

    public function pilihRekon($rekon)
    {
        try {
            $this->rekon = Rekon::where('kode_transaksi', $rekon)->first();
            $this->totalKodeTransaksi = $this->rekon->penerimaan + $this->rekon->pengeluaran;
            $this->modal('lihat-rekon')->close();
        } catch (\Throwable $th) {
            $this->modal('lihat-rekon')->close();
        }
    }

    public function mount()
    {
        $this->nomorBukti = Bkubud::all()->pluck('no_bukti')->toArray();
    }

    #[On('aktif')]
    public function cariBkubud()
    {
        try {
            $this->bkubud = Bkubud::where('no_bukti', 'like', '%' . $this->query . '%')->first();
            $this->totalNomorBukti = $this->bkubud->penerimaan + $this->bkubud->pengeluaran;

            if ($this->totalKodeTransaksi !== $this->totalNomorBukti) {
                $this->bkubud = [];
                $this->totalNomorBukti = '';
                throw new Exception('Data tidak sesuai');
            };

            $this->modal('lihat-bkubud')->close();
        } catch (\Throwable $th) {
            $this->modal('lihat-bkubud')->close();
            $this->dispatch('total-match', message: $th->getMessage(), type: 'error', title: 'Gagal');
        }
    }

    public function simpanEntry()
    {
        try {
            if ($this->totalKodeTransaksi !== $this->totalNomorBukti) throw new Exception('Data tidak sesuai');

            $result = TbData::where('id_rekon', $this->rekon->id_rekon)->first();

            if ($result) throw new Exception('Data sudah ada');

            TbData::create([
                'tanggal_kode_transaksi' => $this->rekon->tanggal,
                'tanggal_nomor_bukti' => $this->bkubud->tanggal,
                'id_rekon' => $this->rekon->id_rekon,
                'kode_transaksi' => $this->kode_transaksi,
                'nomor_bukti' => $this->bkubud->no_bukti,
                'total_rekon' => $this->totalKodeTransaksi,
                'total_bukti' => $this->totalNomorBukti,
                'file_path' => '',
            ]);

            Rekon::where('id_rekon', $this->rekon->id_rekon)->delete();
            Bkubud::where('no_bukti', $this->bkubud->no_bukti)->delete();

            $this->dispatch('total-match', message: 'Data berhasil disimpan', type: 'success', title: 'Berhasil');
        } catch (\Throwable $th) {
            $this->dispatch('total-match', message: $th->getMessage(), type: 'error', title: 'Gagal');
        }
    }


    public function render()
    {
        return view('livewire.entry.index');
    }
}
