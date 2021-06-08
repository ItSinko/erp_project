<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CekPengemasan extends Model
{
    protected $fillable = ['detail_produk_id', 'perlengkapan'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function DetailCekPengemasan()
    {
        return $this->hasMany(DetailCekPengemasan::class);
    }
}
