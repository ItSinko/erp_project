<?php

namespace App;
use App\Kategori_produk
use App\Produk;
use Illuminate\Database\Eloquent\Model;

class Kelompok_produk extends Model
{
    public function Kategori_produk()
    {
        return $this->belongsTo(kategori_produk::class);
    }

    public function Produk()
    {
        $this->hasMany(Produk::class)
    }

}
