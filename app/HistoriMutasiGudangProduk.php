<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriMutasiGudangProduk extends Model
{
    protected $fillable = ['mutasi_gudang_produk_id', 'hasil_perakitan_id', 'status'];

    public function MutasiGudangProduk()
    {
        return $this->belongsTo(MutasiGudangProduk::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}
