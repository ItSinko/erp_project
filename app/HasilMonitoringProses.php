<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilMonitoringProses extends Model
{
    protected $fillable = ['monitoring_proses_id', 'hasil_perakitan_id', 'hasil', 'no_barcode', 'keterangan', 'tindak_lanjut', 'status'];

    public function MonitoringProses()
    {
        return $this->belongsTo(MonitoringProses::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsTo(HasilPerakitan::class);
    }

    public function HasilIkPemeriksaanPengujian()
    {
        return $this->belongsToMany(HasilIkPemeriksaanPengujian::class, 'monitoring_proses_ik_pengujians', 'monitoring_id', 'hasil_ik_id')->withPivot('keterangan')->withTimestamps();
    }

    public function countStatus($status)
    {
        $k = $this->id;
        $u = HasilMonitoringProses::find($k);
        $h = HistoriHasilPerakitan::where([
            ['hasil_perakitan_id', '=', $u->hasil_perakitan_id],
            ['kegiatan', '=', $status]
        ])->count();

        return $h;
    }

    public function PerbaikanProduksi()
    {
        return $this->belongsToMany(PerbaikanProduksi::class, 'perbaikan_produksi_pengujians')->withTimestamps();
    }
}
