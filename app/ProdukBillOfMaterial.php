<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukBillOfMaterial extends Model
{
    protected $fillable = ['detail_produk_id', 'versi'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class);
    }
}
