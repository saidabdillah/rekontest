<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TbData extends Model
{
    protected $guarded = ['id'];

    #[Scope]
    protected function cari(Builder $query, $cari): void
    {
        $query->whereLike('nomor_bukti',  '%' . $cari . '%')
            ->orWhereLike('tanggal_kode_transaksi', '%' . $cari . '%')
            ->orWhereLike('tanggal_nomor_bukti', '%' . $cari . '%')
            ->orWhereLike('kode_transaksi', '%' . $cari . '%');
    }
}
