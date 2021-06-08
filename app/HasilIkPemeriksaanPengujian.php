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

    public function HasilMonitoringProses()
    {
        return $this->belongsToMany(HasilMonitoringProses::class, 'monitoring_proses_ik_pengujians', 'hasil_ik_id', 'monitoring_id')->withPivot('keterangan')->withTimestamps();
    }
}
