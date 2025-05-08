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
        $query->where('nomor_bukti', 'like', '%' . $cari . '%')->orWhere('kode_transaksi', 'like', '%' . $cari . '%');
    }
}
