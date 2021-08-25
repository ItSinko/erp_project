<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bppb;

class DetailProduk extends Model
{
    protected $fillable = ['produk_id', 'kode', 'nama', 'stok', 'harga', 'foto', 'berat'];

    public function ProdukBillOfMaterial()
    {
        return $this->hasMany(ProdukBillOfMaterial::class);
    }

    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function Bppb()
    {
        return $this->hasMany(Bppb::class);
    }

    public function IkPemeriksaanPengujian()
    {
        return $this->hasMany(IkPemeriksaanPengujian::class);
    }

    public function CekPengemasan()
    {
        return $this->hasMany(CekPengemasan::class);
    }

    public function KartuStockGbj()
    {
        return $this->hasOne(KartuStockGbj::class);
    }
}
