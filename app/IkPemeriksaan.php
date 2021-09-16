<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IkPemeriksaan extends Model
{
    protected $fillable = ['detail_produk_id', 'proses', 'keterangan'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function ListIkPemeriksaan()
    {
        return $this->hasMany(ListIkPemeriksaan::class);
    }
}
