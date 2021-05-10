<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaanProsesPengujian extends Model
{
    protected $fillable = ['pemeriksaan_id', 'hasil_ik_id', 'hasil_ok', 'hasil_nok', 'perbaikan', 'karantina', 'keterangan'];

    public function PemeriksaanProsesPengujian()
    {
        return $this->belongsTo(PemeriksaanProses::class, 'pemeriksaan_id');
    }

    public function HasilIkPemeriksaanPengujian()
    {
        return $this->belongsTo(HasilIkPemeriksaanPengujian::class, 'hasil_ik_id');
    }
}
