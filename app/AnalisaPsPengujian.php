<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisaPsPengujian extends Model
{
    protected $fillable = ['hasil_monitoring_proses_id', 'analisa', 'realisasi_pengerjaan', 'tindak_lanjut'];

    public function HasilMonitoringProses()
    {
        return $this->belongsTo(HasilMonitoringProses::class);
    }

    public function BillOfMaterial()
    {
        return $this->belongsToMany(BillOfMaterial::class, 'analisa_ps_pengujian_parts');
    }
}
