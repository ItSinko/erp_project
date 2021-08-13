<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuStockGbj extends Model
{
    protected $fillable = ['detail_produk_id', 'no_kartu'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function DetailKartuStockGbj()
    {
        return $this->hasMany(DetailKartuStockGbj::class, 'kartu_stock_id');
    }
}
