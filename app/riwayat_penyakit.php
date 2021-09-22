<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class riwayat_penyakit extends Model
{
    protected $table = 'riwayat_penyakits';
    protected $fillable = ['karyawan_id', 'nama', 'jenis', 'kriteria', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
}
