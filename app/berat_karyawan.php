<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berat_karyawan extends Model
{
    protected $table = 'berat_karyawans';
    protected $fillable = ['karyawan_id', 'tgl_cek', 'berat', 'lemak', 'kandungan_air', 'otot', 'tulang', 'kalori', 'suhu', 'spo2', 'pr', 'sistolik', 'diastolik', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
}
