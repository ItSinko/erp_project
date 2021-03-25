<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KategoriProduk;
use App\Produk;

class KelompokProduk extends Model
{
    protected $fillable = ['nama'];
    
    public function KategoriProduk()
    {
        return $this->hasMany(KategoriProduk::class);
    }

    public function Produk()
    {
        return $this->hasMany(Produk::class);
    }
}
