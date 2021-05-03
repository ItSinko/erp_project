<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilIkPemeriksaanPengujian extends Model
{
    protected $fillable = ['ik_pemeriksaan_id', 'standar_keberterimaan'];

    public function IkPemeriksaanPengujian()
    {
        return $this->belongsTo(IkPemeriksaanPengujian::class, 'ik_pemeriksaan_id');
    }
}
