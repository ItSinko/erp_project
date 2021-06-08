<?php

namespace App;
use App\Kelompok_produk;
use App\Produk;

use Illuminate\Database\Eloquent\Model;

class Kategori_produk extends Model
{
    

    public function Kelompok_produk()
    {
        return $this->belongsTo(kelompok_produk::class);
    }

    public function Produk()
    {
        $this->hasMany(Produk::class);
    }


}
