<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bppb;

class DetailProduk extends Model
{
    protected $fillable = ['produk_id', 'kode', 'nama', 'stok', 'harga', 'foto', 'berat'];

    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class);
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
}
