<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penawaran_offline extends Model
{
    protected $table = 'penawaran_Offlines';
    protected $primaryKey = 'id';
    protected $fillable = ['offline_id', 'tujuan', 'deskripsi', 'tgl_surat', 'karyawan_id'];

    public function karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
    public function offline()
    {
        return $this->belongsTo('App\Offline', 'offline_id');
    }
}
