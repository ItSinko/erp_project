<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IkPemeriksaan extends Model
{
    protected $fillable = ['detail_produk_id', 'proses'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }
}
