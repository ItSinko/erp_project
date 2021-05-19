<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\HasilPerakitanKaryawan;
use App\Karyawan;
use App\HistoriHasilPerakitan;

class HasilPerakitan extends Model
{
    protected $fillable = ['perakitan_id', 'tanggal', 'no_seri', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'hasil_terbuka', 'tindak_lanjut_terbuka', 'keterangan_tindak_lanjut_terbuka', 'fungsi', 'hasil_tertutup', 'tindak_lanjut_tertutup', 'keterangan_tindak_lanjut_tertutup', 'keterangan', 'status'];

    public function Perakitan()
    {
        return $this->belongsTo(Perakitan::class);
    }

    public function HistoriHasilPerakitan()
    {
        return $this->hasMany(HistoriHasilPerakitan::class);
    }

    public function HasilMonitoringProses()
    {
        return $this->hasMany(HasilMonitoringProses::class);
    }

    public function HasilPengemasan()
    {
        return $this->hasMany(HasilPengemasan::class);
    }

    public function PerbaikanProduksi()
    {
        return $this->belongsToMany(PerbaikanProduksi::class, 'perbaikan_produksi_no_seris');
    }

    public function countStatus($status)
    {
        $k = $this->id;
        $h = HistoriHasilPerakitan::where([
            ['hasil_perakitan_id', '=', $k],
            ['kegiatan', '=', $status]
        ])->count();

        return $h;
    }
}
