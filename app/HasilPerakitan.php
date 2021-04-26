<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\HasilPerakitanKaryawan;
use App\Karyawan;
use App\HistoriHasilPerakitan;

class HasilPerakitan extends Model
{
    protected $fillable = ['perakitan_id', 'tanggal', 'no_seri', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'keterangan_tindak_lanjut_terbuka', 'fungsi', 'hasil', 'tindak_lanjut_tertutup', 'keterangan_tindak_lanjut_tertutup', 'keterangan'];

    public function Perakitan()
    {
        return $this->belongsTo(Perakitan::class);
    }

    public function HistoriHasilPerakitan()
    {
        return $this->hasMany(HistoriHasilPerakitan::class);
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
