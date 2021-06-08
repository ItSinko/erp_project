<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kesehatan_harian extends Model
{
    protected $table = 'kesehatan_harians';
    protected $primaryKey = 'id';
    protected $fillable = ['tgl_cek', 'karyawan_id', 'suhu_pagi', 'suhu_siang', 'spo2', 'pr', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}
