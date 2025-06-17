<?php

namespace App\Livewire\Laporan;

use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class Laporan extends Component
{
    public $tanggal_akhir;
    public $CHP_1_L = 0;
    public $CHP_2_L = 0;
    public $CHP_3_L = 0;
    public $CHP_4_L = 0;
    public $CHP_5_L = 0;
    public $CHP_6_L = 0;
    public $CHP_7_L = 0;
    public $CHP_1_S = 0;
    public $CHP_2_S = 0;
    public $CHP_3_S = 0;
    public $CHP_4_S = 0;
    public $CHP_5_S = 0;
    public $CHP_6_S = 0;
    public $CHP_7_S = 0;
    public $CHP_8_S = 0;
    public $CHP_9_S = 0;
    public $CHP_10_S = 0;
    public $CHP_11_S = 0;
    public $CHP_12_S = 0;
    public $CHP_13_S = 0;
    public $CHP_14_S = 0;
    public $CHP_15_S = 0;
    public $CHP_16_S = 0;
    public $CHP_17_S = 0;
    public $CHP_1_P = 0;
    public $CHP_2_P = 0;
    public $CHP_3_P = 0;
    public $CHP_4_P = 0;
    public $CHP_5_P = 0;
    public $CHP_6_P = 0;
    public $CHP_7_P = 0;
    public $CHP_8_P = 0;
    public $CHP_9_P = 0;
    public $CHP_10_P = 0;
    public $CHP_11_P = 0;
    public $CHP_12_P = 0;
    public $CHP_13_P = 0;
    public $CHP_14_P = 0;
    public $CHP_15_P = 0;
    public $CHP_16_P = 0;
    public $CHP_17_P = 0;
    public $CHP_18_P = 0;
    public $CHP_19_P = 0;
    public $CHP_20_P = 0;
    public $CHP_21_P = 0;
    public $CHP_22_P = 0;
    public $CHP_23_P = 0;
    public $CHP_24_P = 0;
    public $CHP_1_B = 0;
    public $CHP_2_B = 0;
    public $CHP_3_B = 0;
    public $CHP_4_B = 0;
    public $CHP_5_B = 0;
    public $CHP_6_B = 0;
    public $CHP_7_B = 0;
    public $CHP_8_B = 0;
    public $CHP_9_B = 0;
    public $CHP_10_B = 0;
    public $CHP_11_B = 0;
    public $CHP_12_B = 0;
    public $CHP_13_B = 0;
    public $CHP_14_B = 0;
    public $CHP_15_B = 0;
    public $CHP_16_B = 0;
    public $CHP_17_B = 0;
    public $CHP_18_B = 0;
    public $CHP_19_B = 0;
    public $CHP_20_B = 0;
    public $CHP_21_B = 0;
    public $CHP_22_B = 0;

    public function cariTanggal()
    {
        if (empty($this->tanggal_akhir)) {
            return LivewireAlert::title('Gagal')->error('Tanggal belum diisi')->text('Silahkan isi tanggal')->show();
        }

        $registerSp2d = DB::table('tb_reg_sp2d')
            ->selectRaw(
                "SUM(CASE WHEN jenis = 'Langsung (LS)' THEN bruto ELSE 0 END) AS TotalSP2DLs,
                SUM(CASE WHEN jenis = 'Ganti Uang Persediaan (GU)' THEN bruto ELSE 0 END) AS TotalSP2DGu,
                SUM(CASE WHEN jenis = 'Nihil (NIHIL)' THEN bruto ELSE 0 END) AS TotalSP2DNihil,
                SUM(CASE WHEN jenis = 'Uang Persediaan (UP)' THEN bruto ELSE 0 END) AS TotalSP2DUp,
                SUM(CASE WHEN jenis = 'Tambahan Uang Persediaan (TU)' THEN bruto ELSE 0 END) AS TotalSP2DTu,
                SUM(bruto) - SUM(CASE WHEN jenis IN ('Uang Persediaan (UP)', 'Tambahan Uang Persediaan (TU)') THEN bruto ELSE 0 END) AS TotalSP2D"
            )
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $rekeningKoran = DB::table('rekon')
            ->selectRaw(
                "IFNULL(SUM(penerimaan), 0) AS MutasiKredit, 
                IFNULL(SUM(pengeluaran), 0) AS MutasiDebet"
            )
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $pendapatan = DB::table('bkubud')
            ->selectRaw("SUM(penerimaan) AS TotalPendapatan")
            ->where('no_bukti', 'LIKE', '%STS%')
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $awal = DB::table('tb_saldo_awal')->first();

        $pembiayaanPengeluaran = DB::table('tb_reg_sp2d')
            ->selectRaw("IFNULL(SUM(bruto), 0) AS PembiayaanPengeluaran")
            ->whereLike('keterangan', '%PENYERTAAN%')
            ->where('sub_unit', 'PEJABAT PENGELOLA KEUANGAN DAERAH (PPKD)')
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $belumEntry = DB::table('rekon')
            ->leftJoin('tb_data', 'rekon.id_rekon', '=', 'tb_data.id_rekon')
            ->selectRaw('IFNULL(SUM(rekon.penerimaan), 0) AS BelumEntry')
            ->whereNull('tb_data.id_rekon')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $belumSetor = DB::table('bkubud')
            ->leftJoin('tb_data', 'bkubud.no_bukti', '=', 'tb_data.nomor_bukti')
            ->selectRaw('IFNULL(SUM(bkubud.penerimaan), 0) AS BelumSetor')
            ->whereNull('tb_data.nomor_bukti')
            ->where('bkubud.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        // $belumSetor = DB::table('bkubud')
        //     ->leftJoin('tb_data', function ($join) {
        //         $join->on('bkubud.no_bukti', '=', 'tb_data.nomor_bukti')
        //             ->on('bkubud.tanggal', '=', 'tb_data.tanggal_nomor_bukti');
        //     })
        //     ->selectRaw('IFNULL(SUM(bkubud.penerimaan), 0) AS BelumSetor')
        //     ->where('bkubud.tanggal', '<=', $this->tanggal_akhir)
        //     ->whereNotNull('bkubud.no_bukti')
        //     ->where(function ($query) {
        //         $query->where('tb_data.tanggal_kode_transaksi', '>', $this->tanggal_akhir)
        //             ->orWhereNull('tb_data.kode_transaksi');
        //     })
        //     ->first();

        $belumCair = DB::table('tb_reg_sp2d')
            ->selectRaw("IFNULL(SUM(bruto), 0) AS BelumCair")
            ->leftJoin('tb_data', 'tb_reg_sp2d.no_sp2d', '=', 'tb_data.nomor_bukti')
            ->where('tb_reg_sp2d.tanggal', '<=', $this->tanggal_akhir)
            ->where('tb_data.tanggal_kode_transaksi', '>', $this->tanggal_akhir) // hanya ini
            ->first();

        $upTu = DB::table('tb_reg_sp2d')
            ->selectRaw("IFNULL(SUM(bruto), 0) AS PengeluaranUp")
            ->leftJoin('tb_data', 'tb_reg_sp2d.no_sp2d', '=', 'tb_data.nomor_bukti')
            ->where('tb_reg_sp2d.tanggal', '<=', $this->tanggal_akhir)
            ->where('tb_data.tanggal_kode_transaksi', '<=', $this->tanggal_akhir)
            ->where('tb_reg_sp2d.jenis', 'Uang Persediaan (UP)')
            ->first();

        $nonSp2d = DB::table('tb_reg_spb')
            ->selectRaw(
                "IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BLUD' THEN tb_reg_spb.pendapatan ELSE 0 END), 0) AS TotalPendapatanBlud,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BLUD' THEN tb_reg_spb.belanja ELSE 0 END), 0) AS TotalBelanjaBlud,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'JKN' THEN tb_reg_spb.pendapatan ELSE 0 END), 0) AS TotalPendapatanJkn,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'JKN' THEN tb_reg_spb.belanja ELSE 0 END), 0) AS TotalBelanjaJkn,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOK' THEN tb_reg_spb.pendapatan ELSE 0 END), 0) AS TotalPendapatanBok,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOK' THEN tb_reg_spb.belanja ELSE 0 END), 0) AS TotalBelanjaBok,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOS' THEN tb_reg_spb.pendapatan ELSE 0 END), 0) AS TotalPendapatanBos,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOS' THEN tb_reg_spb.belanja ELSE 0 END), 0) AS TotalBelanjaBos,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOP' THEN tb_reg_spb.pendapatan ELSE 0 END), 0) AS TotalPendapatanBop,
                IFNULL(SUM(CASE WHEN tb_reg_spb.jenis = 'BOP' THEN tb_reg_spb.belanja ELSE 0 END), 0) AS TotalBelanjaBop"
            )
            ->join('tb_sub_unit', 'tb_reg_spb.sub_unit', '=', 'tb_sub_unit.subunit')
            ->where('tb_reg_spb.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $pengBos = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(rekon.penerimaan), 0) AS PENGEMBALIAN_BOS")
            ->leftJoin('rekon', 'tb_data.id_rekon', '=', 'rekon.id_rekon')
            ->where('tb_data.nomor_bukti', 'PENGEMBALIAN_BOS')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $kormut = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(rekon.penerimaan), 0) AS krt")
            ->leftJoin('rekon', 'tb_data.id_rekon', '=', 'rekon.id_rekon')
            ->where('tb_data.nomor_bukti', 'KORMUT')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $kormutPenge = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(rekon.pengeluaran), 0) AS krt_peng")
            ->leftJoin('rekon', 'tb_data.id_rekon', '=', 'rekon.id_rekon')
            ->where('tb_data.nomor_bukti', 'KORMUT')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $ttpDeposito = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(rekon.penerimaan), 0) AS nilai")
            ->leftJoin('rekon', 'tb_data.id_rekon', '=', 'rekon.id_rekon')
            ->where('tb_data.nomor_bukti', 'DEPOSITO')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $bukaDeposito = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(rekon.pengeluaran), 0) AS nilai")
            ->leftJoin('rekon', 'tb_data.id_rekon', '=', 'rekon.id_rekon')
            ->where('tb_data.nomor_bukti', 'DEPOSITO')
            ->where('rekon.tanggal', '<=', $this->tanggal_akhir)
            ->first();

        // $lebihCtt = DB::table('kelebihan_entry_1')
        //     ->selectRaw("IFNULL(SUM(lebih_entry), 0) AS SELISIH")
        //     ->where('tgl_kode_transaksi', '<=', $this->tanggal_akhir)
        //     ->first();

        // Ambil NB
        $sub1 = DB::table('tb_data')
            ->select(
                'tanggal_kode_transaksi',
                'kode_transaksi',
                'id_rekon',
                DB::raw('COALESCE(SUM(total_bukti),0) AS NB'),
                DB::raw('0 AS NR')
            )
            ->where('tanggal_kode_transaksi', '<=', $this->tanggal_akhir)
            ->groupBy('tanggal_kode_transaksi', 'kode_transaksi', 'id_rekon');


        // Ambil NR
        $sub2 = DB::table('tb_data')
            ->select(
                'tanggal_kode_transaksi',
                'kode_transaksi',
                'id_rekon',
                DB::raw('0 AS NB'),
                DB::raw('COALESCE(total_rekon,0) AS NR')
            )
            ->where('tanggal_kode_transaksi', '<=', $this->tanggal_akhir)
            ->groupBy('tanggal_kode_transaksi', 'kode_transaksi', 'id_rekon', 'total_rekon');

        // UNION kedua subquery di atas
        $union = $sub1->unionAll($sub2);

        // Dari hasil UNION, hitung total NB - NR
        $lebihCtt = DB::query()
            ->fromSub($union, 'KELEBIHAN_ENTRY')
            ->selectRaw('COALESCE(SUM(NB),0) - COALESCE(SUM(NR),0) AS SELISIH')
            ->first();

        $pbd = DB::table('tb_data')
            ->selectRaw("IFNULL(SUM(total_bukti), 0) AS PENGEMBALIAN")
            ->where('nomor_bukti', 'LIKE', '%/PB/%')
            ->where('tanggal_kode_transaksi', '<=', $this->tanggal_akhir)
            ->first();

        $stu = DB::table('bkubud')
            ->selectRaw("IFNULL(SUM(penerimaan), 0) AS Sisa_TU")
            ->where(function ($query) {
                $query->where('uraian', 'LIKE', '%Pengembalian Sisa TU%')
                    ->orWhere('uraian', 'Pemindah Bukuan Belanja Tidak Terduga Santunan Kematian Tahun 2024.');
            })
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        $sup = DB::table('tb_pengembalian_sisa_up')
            ->selectRaw("IFNULL(SUM(nilai), 0) AS S3UP")
            ->where('tanggal', '<=', $this->tanggal_akhir)
            ->first();

        // Calculate all CHP values
        $totalPendapatan = ($pendapatan->TotalPendapatan ?? 0) +
            ($nonSp2d->TotalPendapatanBlud ?? 0) +
            ($nonSp2d->TotalPendapatanBok ?? 0) +
            ($nonSp2d->TotalPendapatanBop ?? 0) +
            ($nonSp2d->TotalPendapatanBos ?? 0) +
            ($nonSp2d->TotalPendapatanJkn ?? 0);

        $totalBelanja = ($registerSp2d->TotalSP2D ?? 0) +
            ($nonSp2d->TotalBelanjaBlud ?? 0) +
            ($nonSp2d->TotalBelanjaBok ?? 0) +
            ($nonSp2d->TotalBelanjaBop ?? 0) +
            ($nonSp2d->TotalBelanjaBos ?? 0) +
            ($nonSp2d->TotalBelanjaJkn ?? 0);

        // dd($nonSp2d);

        // dd($awal);
        $saldoAwal = ($awal->giro ?? 0) + ($awal->blud ?? 0) + ($awal->deposito ?? 0) +
            ($awal->bok ?? 0) + ($awal->jkn ?? 0) + ($awal->bos ?? 0) +
            ($awal->bop ?? 0) + ($awal->penerimaan ?? 0) + ($awal->pengeluaran ?? 0);

        // dd($pembiayaanPengeluaran);
        // total pendapatan = 42331500 
        // total belanja = 612285895017 
        // saldo awal = 6459519435588700  
        // pengembalias bos = 0
        // pembiayaan pengeluaran = 0

        // CHP_L calculations
        $this->CHP_1_L = $totalPendapatan - ($sup->S3UP ?? 0);
        $this->CHP_2_L = $totalBelanja - ($pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0) - ($pbd->PENGEMBALIAN ?? 0);
        $this->CHP_3_L = $totalPendapatan - $totalBelanja;
        $this->CHP_4_L = $saldoAwal;
        $this->CHP_5_L = $pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0;
        $this->CHP_6_L = $saldoAwal + ($pengBos->PENGEMBALIAN_BOS ?? 0) - ($pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0);
        $this->CHP_7_L = ($totalPendapatan - $totalBelanja) + ($saldoAwal + ($pengBos->PENGEMBALIAN_BOS ?? 0)) - ($pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0);

        // CHP_S calculations
        $this->CHP_1_S = ($awal->giro ?? 0) + ($rekeningKoran->MutasiKredit ?? 0) - ($rekeningKoran->MutasiDebet ?? 0);
        $this->CHP_2_S = ($awal->deposito ?? 0) + ($bukaDeposito->nilai ?? 0) - ($ttpDeposito->nilai ?? 0);
        $this->CHP_3_S = ($awal->jkn ?? 0) + ($nonSp2d->TotalPendapatanJkn ?? 0) - ($nonSp2d->TotalBelanjaJkn ?? 0);
        $this->CHP_4_S = ($awal->blud ?? 0) + ($nonSp2d->TotalPendapatanBlud ?? 0) - ($nonSp2d->TotalBelanjaBlud ?? 0);
        $this->CHP_5_S = ($belumSetor->BelumSetor ?? 0) + ($lebihCtt->SELISIH ?? 0);
        $this->CHP_6_S = ($registerSp2d->TotalSP2DUp ?? 0) + ($registerSp2d->TotalSP2DTu ?? 0) - ($registerSp2d->TotalSP2DNihil ?? 0) - ($stu->Sisa_TU ?? 0) - ($sup->S3UP ?? 0);
        $this->CHP_7_S = ($awal->bos ?? 0) + ($nonSp2d->TotalPendapatanBos ?? 0) - ($nonSp2d->TotalBelanjaBos ?? 0) - ($pengBos->PENGEMBALIAN_BOS ?? 0);
        $this->CHP_8_S = ($awal->bop ?? 0) + ($nonSp2d->TotalPendapatanBop ?? 0) - ($nonSp2d->TotalBelanjaBop ?? 0);
        $this->CHP_9_S = ($awal->bok ?? 0) + ($nonSp2d->TotalPendapatanBok ?? 0) - ($nonSp2d->TotalBelanjaBok ?? 0);
        $this->CHP_10_S = $this->CHP_1_S + $this->CHP_2_S + $this->CHP_3_S + $this->CHP_4_S + $this->CHP_5_S  + $this->CHP_6_S + $this->CHP_7_S + $this->CHP_8_S + $this->CHP_9_S;
        $this->CHP_11_S = $this->CHP_7_L - $this->CHP_10_S;
        $this->CHP_12_S = 0;
        $this->CHP_13_S = $belumCair->BelumCair ?? 0;
        $this->CHP_14_S = $belumEntry->BelumEntry ?? 0;
        $this->CHP_15_S = $sup->S3UP ?? 0;
        $this->CHP_16_S = ($kormut->krt ?? 0) - ($kormutPenge->krt_peng ?? 0);
        $this->CHP_17_S = $this->CHP_11_S + $this->CHP_12_S + $this->CHP_13_S + $this->CHP_14_S + $this->CHP_15_S + $this->CHP_16_S;
        // $this->CHP_17_S = (($this->CHP_1_S + $this->CHP_2_S + $this->CHP_3_S + $this->CHP_4_S + $this->CHP_5_S + ($registerSp2d->TotalSP2DUp ?? 0) + $this->CHP_7_S + $this->CHP_8_S + $this->CHP_9_S) -
        //     (($totalPendapatan - $totalBelanja) + ($saldoAwal + ($pengBos->PENGEMBALIAN_BOS ?? 0)) - ($pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0)) -
        //     (($belumCair->BelumCair ?? 0) + ($belumEntry->BelumEntry ?? 0)));

        // CHP_P calculations
        $this->CHP_1_P = $rekeningKoran->MutasiKredit ?? 0;
        $this->CHP_2_P = ($belumSetor->BelumSetor ?? 0) - ($sup->S3UP ?? 0);
        $this->CHP_3_P = $lebihCtt->SELISIH ?? 0;
        $this->CHP_4_P = $this->CHP_2_P + $this->CHP_3_P;
        // $this->CHP_4_P = ($belumSetor->BelumSetor ?? 0) + 0;
        $this->CHP_5_P = $this->CHP_14_S;
        // $this->CHP_5_P = $belumEntry->BelumEntry ?? 0;
        $this->CHP_6_P = $kormut->krt ?? 0;
        $this->CHP_7_P = 0;
        $this->CHP_8_P = $ttpDeposito->nilai ?? 0;
        $this->CHP_9_P = 0;
        $this->CHP_10_P = $stu->Sisa_TU ?? 0;
        $this->CHP_11_P = $pbd->PENGEMBALIAN ?? 0;
        $this->CHP_12_P = 0;
        $this->CHP_13_P = $pengBos->PENGEMBALIAN_BOS ?? 0;
        $this->CHP_14_P = $this->CHP_5_P + $this->CHP_6_P + $this->CHP_7_P + $this->CHP_8_P + $this->CHP_9_P + $this->CHP_10_P + $this->CHP_11_P + $this->CHP_12_P + $this->CHP_13_P;
        // $this->CHP_14_P = ($belumEntry->BelumEntry ?? 0) + ($pengBos->PENGEMBALIAN_BOS ?? 0) + ($kormut->krt ?? 0);
        $this->CHP_15_P = ($rekeningKoran->MutasiKredit ?? 0) + (($belumSetor->BelumSetor ?? 0) + 0) - (($belumEntry->BelumEntry ?? 0) + ($pengBos->PENGEMBALIAN_BOS ?? 0) + ($kormut->krt ?? 0));
        $this->CHP_16_P = $nonSp2d->TotalPendapatanJkn ?? 0;
        $this->CHP_17_P = $nonSp2d->TotalPendapatanBlud ?? 0;
        $this->CHP_18_P = $nonSp2d->TotalPendapatanBos ?? 0;
        $this->CHP_19_P = 0;
        $this->CHP_20_P = $nonSp2d->TotalPendapatanBok ?? 0;
        $this->CHP_21_P = $nonSp2d->TotalPendapatanBop ?? 0;
        $this->CHP_22_P = $this->CHP_15_P + $this->CHP_16_P + $this->CHP_17_P + $this->CHP_18_P + $this->CHP_19_P + $this->CHP_20_P + $this->CHP_21_P;
        // $this->CHP_22_P = (($rekeningKoran->MutasiKredit ?? 0) + (($belumSetor->BelumSetor ?? 0) + 0) - (($belumEntry->BelumEntry ?? 0) + ($pengBos->PENGEMBALIAN_BOS ?? 0) + ($kormut->krt ?? 0))) +
        //     (($nonSp2d->TotalPendapatanJkn ?? 0) + ($nonSp2d->TotalPendapatanBlud ?? 0) + ($nonSp2d->TotalPendapatanBos ?? 0) + 0 + ($nonSp2d->TotalPendapatanBok ?? 0) + ($nonSp2d->TotalPendapatanBop ?? 0));
        $this->CHP_23_P = $this->CHP_1_L;
        $this->CHP_24_P = $this->CHP_22_P - $this->CHP_23_P;
        // $this->CHP_24_P = (($rekeningKoran->MutasiKredit ?? 0) + (($belumSetor->BelumSetor ?? 0) + 0) - (($belumEntry->BelumEntry ?? 0) + ($pengBos->PENGEMBALIAN_BOS ?? 0) + ($kormut->krt ?? 0))) +
        //     (($nonSp2d->TotalPendapatanJkn ?? 0) + ($nonSp2d->TotalPendapatanBlud ?? 0) + ($nonSp2d->TotalPendapatanBos ?? 0) + 0 + ($nonSp2d->TotalPendapatanBok ?? 0) + ($nonSp2d->TotalPendapatanBop ?? 0)) -
        //     $totalPendapatan;

        // CHP_B calculations
        $this->CHP_1_B = $rekeningKoran->MutasiDebet ?? 0;
        $this->CHP_2_B = $belumCair->BelumCair ?? 0;
        $this->CHP_3_B = 0;
        $this->CHP_4_B = $this->CHP_2_B + $this->CHP_3_B;
        // $this->CHP_4_B = ($belumCair->BelumCair ?? 0) + 0;
        $this->CHP_5_B = $bukaDeposito->nilai ?? 0;
        $this->CHP_6_B = $pbd->PENGEMBALIAN ?? 0;
        $this->CHP_7_B = ($registerSp2d->TotalSP2DUp ?? 0) + ($registerSp2d->TotalSP2DTu ?? 0) - ($registerSp2d->TotalSP2DNihil ?? 0) - ($stu->Sisa_TU ?? 0) - ($sup->S3UP ?? 0);
        $this->CHP_8_B = $kormutPenge->krt_peng ?? 0;
        $this->CHP_9_B = 0;
        $this->CHP_10_B = $pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0;
        $this->CHP_11_B = ($stu->Sisa_TU ?? 0) + ($sup->S3UP ?? 0);
        $this->CHP_12_B = $this->CHP_5_B + $this->CHP_6_B + $this->CHP_7_B + $this->CHP_8_B + $this->CHP_9_B + $this->CHP_10_B + $this->CHP_11_B;
        // $this->CHP_12_B = ($registerSp2d->TotalSP2DUp ?? 0) + ($kormut->krt ?? 0);
        $this->CHP_13_B = $this->CHP_1_B + $this->CHP_4_B - $this->CHP_12_B;
        // $this->CHP_13_B = ($rekeningKoran->MutasiDebet ?? 0) + (($belumCair->BelumCair ?? 0) + 0) - (($registerSp2d->TotalSP2DUp ?? 0) + ($kormut->krt ?? 0));
        $this->CHP_14_B = $nonSp2d->TotalBelanjaJkn ?? 0;
        $this->CHP_15_B = $nonSp2d->TotalBelanjaBlud ?? 0;
        $this->CHP_16_B = $nonSp2d->TotalBelanjaBos ?? 0;
        $this->CHP_17_B = 0;
        $this->CHP_18_B = $nonSp2d->TotalBelanjaBok ?? 0;
        $this->CHP_19_B = $nonSp2d->TotalBelanjaBop ?? 0;
        $this->CHP_20_B = $this->CHP_13_B + $this->CHP_14_B + $this->CHP_15_B + $this->CHP_16_B + $this->CHP_17_B + $this->CHP_18_B + $this->CHP_19_B;
        // $this->CHP_20_B = ($rekeningKoran->MutasiDebet ?? 0) + (($belumCair->BelumCair ?? 0) + 0) - (($registerSp2d->TotalSP2DUp ?? 0) + ($kormut->krt ?? 0)) +
        //     (($nonSp2d->TotalBelanjaJkn ?? 0) + ($nonSp2d->TotalBelanjaBlud ?? 0) + ($nonSp2d->TotalBelanjaBos ?? 0) + 0 + ($nonSp2d->TotalBelanjaBok ?? 0) + ($nonSp2d->TotalBelanjaBop ?? 0));
        $this->CHP_21_B = $this->CHP_2_L;
        // $this->CHP_21_B = $totalBelanja - ($pembiayaanPengeluaran->PembiayaanPengeluaran ?? 0) - ($pbd->PENGEMBALIAN ?? 0);
        $this->CHP_22_B = $this->CHP_20_B - $this->CHP_21_B;
        // $this->CHP_22_B = ($rekeningKoran->MutasiDebet ?? 0) + (($belumCair->BelumCair ?? 0) + 0) - (($registerSp2d->TotalSP2DUp ?? 0) + ($kormut->krt ?? 0)) +
        //     (($nonSp2d->TotalBelanjaJkn ?? 0) + ($nonSp2d->TotalBelanjaBlud ?? 0) + ($nonSp2d->TotalBelanjaBos ?? 0) + 0 + ($nonSp2d->TotalBelanjaBok ?? 0) + ($nonSp2d->TotalBelanjaBop ?? 0)) -
        //     $totalBelanja;
    }

    public function render()
    {
        return view('livewire.laporan.laporan');
    }
}
