<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berat_karyawan extends Model
{
    protected $table = 'berat_karyawans';
    protected $primaryKey = 'id';
    protected $fillable = ['kesehatan_awal_id', 'tgl_cek', 'berat', 'lemak', 'kandungan_air', 'otot', 'tulang', 'kalori', 'keterangan'];

    public function Kesehatan_awal()
    {
        return $this->belongsTo('App\Kesehatan_awal', 'kesehatan_awal_id');
    }
}
