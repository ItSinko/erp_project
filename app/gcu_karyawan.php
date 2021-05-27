<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gcu_karyawan extends Model
{
    protected $table = 'gcu_karyawans';
    protected $primaryKey = 'id';
    protected $fillable = ['karyawan_id', 'tgl_cek', 'glukosa', 'kolesterol', 'asam_urat', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}
