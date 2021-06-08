<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class karyawan_masuk extends Model
{
    protected $tables = "karyawan_masuks";
    protected $fillable = ['karyawan_id', 'pemeriksa_id', 'karyawan_sakit_id', 'tgl_cek', 'alasan', 'keterangan'];

    public function karyawan()
    {
        return $this->belongsTo('App\karyawan', 'karyawan_id');
    }
    public function pemeriksa()
    {
        return $this->belongsTo('App\karyawan', 'pemeriksa_id');
    }
    public function obat()
    {
        return $this->belongsTo('App\obat', 'obat_id');
    }
}
