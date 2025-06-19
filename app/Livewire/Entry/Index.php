<?php

namespace App\Livewire\Entry;

use App\Models\Bkubud;
use App\Models\Rekon;
use App\Models\TbData;
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
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
    public $totalNomorBukti = '';

    public $query = '';
    use WithFileUploads;

    #[Validate('required|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image;


    public function deleteQuery()
    {
        $this->query = '';
        $this->dispatch('cari-bkubuds');
    }

    #[On('cari-bkubuds')]
    public function cariBkubuds()
    {
        $this->bkubuds = Bkubud::whereLike('no_bukti', '%' . $this->query . '%')
            ->orWhereLike('uraian', '%' . $this->query . '%')
            ->orWhereLike('penerimaan', '%' . $this->query . '%')
            ->orWhereLike('pengeluaran', '%' . $this->query . '%')
            ->limit(50)
            ->get();
        $this->totalNomorBukti = '';
    }

    public function pilihBkubud($bkubud)
    {
        $this->query = $bkubud;
        $this->dispatch('cari-bkubuds');
    }

    public function cariBkubud()
    {
        $this->validate([
            'query' => 'required',
        ], [
            'query.required' => 'Pilih data dulu.',
        ]);
        try {
            // if (empty($this->query)) throw new Exception('Pilih data dulu.');
            $this->bkubud = Bkubud::whereLike('no_bukti', '%' . $this->query . '%')
                ->orWhereLike('uraian', '%' . $this->query . '%')
                ->orWhereLike('penerimaan', '%' . $this->query . '%')
                ->orWhereLike('pengeluaran', '%' . $this->query . '%')
                ->first();
            $this->totalNomorBukti = $this->bkubud->penerimaan + $this->bkubud->pengeluaran;
            if (!$this->bkubud) throw new Exception('Data tidak ditemukan');
            $this->modal('lihat-bkubud')->close();
        } catch (\Throwable $th) {
            $this->modal('lihat-bkubud')->close();
            LivewireAlert::title('Gagal!')
                ->text($th->getMessage())
                ->error()
                ->show();
        }
    }

    public function cariTanggal()
    {
        $this->kodeTransaksi = Rekon::where('tanggal', $this->tanggal)->get();
    }

    public function cariRekon()
    {
        $this->validate([
            'tanggal' => 'required',
            'kode_transaksi' => 'required',
        ], [
            'tanggal.required' => 'Pilih tanggal dulu.',
            'kode_transaksi.required' => 'Pilih kode transaksi dulu.',
        ]);

        try {
            $this->rekon = Rekon::where('kode_transaksi', $this->kode_transaksi)->first();
            $this->totalKodeTransaksi = $this->rekon->penerimaan + $this->rekon->pengeluaran;
            $this->modal('lihat-rekon')->close();
        } catch (\Throwable $th) {
            $this->modal('lihat-rekon')->close();
            LivewireAlert::title('Gagal!')
                ->error()
                ->show();
        }
    }

    public function simpanEntry()
    {
        try {

            if (empty($this->rekon) || empty($this->bkubud)) throw new Exception('Data tidak boleh kosong');
            if ($this->totalKodeTransaksi !== $this->totalNomorBukti) throw new Exception('Data tidak sesuai');

            $rekon = TbData::where('id_rekon', $this->rekon->id_rekon)->first();
            $bkubud = TbData::where('nomor_bukti', $this->bkubud->no_bukti)->first();

            if ($rekon) throw new Exception('Data sudah ada');
            if ($bkubud) throw new Exception('Data sudah ada');

            TbData::create([
                'tanggal_kode_transaksi' => $this->rekon->tanggal,
                'tanggal_nomor_bukti' => $this->bkubud->tanggal,
                'id_rekon' => $this->rekon->id_rekon,
                'kode_transaksi' => $this->kode_transaksi,
                'nomor_bukti' => $this->bkubud->no_bukti,
                'total_rekon' => $this->totalKodeTransaksi,
                'total_bukti' => $this->totalNomorBukti,
            ]);

            Rekon::where('id_rekon', $this->rekon->id_rekon)->delete();
            Bkubud::where('no_bukti', $this->bkubud->no_bukti)->delete();

            $this->reset();
            LivewireAlert::title('Berhasil!')
                ->success()
                ->show();
        } catch (\Throwable $th) {
            LivewireAlert::title('Gagal!')
                ->text($th->getMessage())
                ->error()
                ->show();
        }
    }


    public function render()
    {
        return view('livewire.entry.index');
    }
}
