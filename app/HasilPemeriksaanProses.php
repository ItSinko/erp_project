<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaanProses extends Model
{
    protected $fillable = ['pemeriksaan_proses_id', 'detail_ik_pemeriksaan_id', 'jumlah', 'hasil_ok', 'hasil_nok', 'tindak_lanjut', 'keterangan'];

    public function PemeriksaanProses()
    {
        return $this->belongsTo(PemeriksaanProses::class);
    }

    public function DetailIkPemeriksaan()
    {
        return $this->belongsTo(DetailIkPemeriksaan::class);
    }
}
