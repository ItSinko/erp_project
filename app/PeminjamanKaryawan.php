<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Karyawan;
use App\DetailPeminjamanKaryawan;

class PeminjamanKaryawan extends Model
{
    protected $fillable = ['penanggung_jawab_id', 'nama_penugasan', 'tanggal_pembuatan', 'tanggal_penugasan', 'tanggal_estimasi_selesai', 'tanggal_selesai', 'keterangan'];

    public function PenanggungJawab()
    {
        return $this->belongsTo(Karyawan::class, 'penanggung_jawab_id');
    }

    public function DetailPeminjamanKaryawan()
    {
        return $this->hasMany(DetailPeminjamanKaryawan::class);
    }
}
