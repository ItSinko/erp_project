<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kesehatan_tahunan extends Model
{
    protected $table = 'kesehatan_tahunans';
    protected $primaryKey = 'id';
    protected $fillable = ['karyawan_id', 'pemeriksa_id', 'tgl_cek', 'mata_kiri', 'mata_kanan', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
    public function Pemeriksa()
    {
        return $this->belongsTo('App\Karyawan', 'pemeriksa_id');
    }
}
