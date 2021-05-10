<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilMonitoringProses extends Model
{
    protected $fillable = ['monitoring_proses_id', 'hasil_perakitan_id', 'hasil', 'no_barcode', 'keterangan', 'tindak_lanjut'];

    public function MonitoringProses()
    {
        return $this->belongsTo(MonitoringProses::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }
}