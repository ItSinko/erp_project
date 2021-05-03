<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IkPemeriksaanPengujian extends Model
{
    protected $fillable = ['detail_produk_id', 'hal_yang_diperiksa'];

    public function HasilIkPemeriksaanPengujian()
    {
        return $this->hasMany(HasilIkPemeriksaanPengujian::class, 'ik_pemeriksaan_id');
    }

    public function Produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
