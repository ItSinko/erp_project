<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPersiapanPackingProduk extends Model
{
    protected $fillable = ['persiapan_id', 'dokumen', 'ketersediaan', 'keterangan', 'ukuran', 'model', 'warna_kertas', 'warna_tirta', 'verifikasi'];

    public function PersiapanPackingProduk()
    {
        return $this->belongsTo(PersiapanPackingProduk::class, 'persiapan_id');
    }
}
