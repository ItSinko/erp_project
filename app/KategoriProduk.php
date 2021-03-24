<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\KelompokProduk;
use App\Produk;

class KategoriProduk extends Model
{
    protected $fillable = ['kelompok_produk_id','nama'];

    public function KelompokProduk()
    {
        return $this->belongsTo(KelompokProduk::class);
    }
    
    public function Produk()
    {
        return $this->hasMany(Produk::class);
    }

}
