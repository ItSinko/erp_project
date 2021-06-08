<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kesehatan_mingguan_tensi extends Model
{
    protected $table = 'kesehatan_mingguan_tensis';
    protected $primaryKey = 'id';
    protected $fillable = ['karyawan_id', 'tgl_cek', 'sistolik', 'diastolik', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}
