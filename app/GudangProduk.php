<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangProduk extends Model
{
    protected $fillable = ['divisi_id', 'detail_produk_id', 'nomor'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function MutasiGudangProduk()
    {
        return $this->hasMany(MutasiGudangProduk::class);
    }
}
