<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kesehatan_mingguan_rapid extends Model
{
    protected $table = 'kesehatan_mingguan_rapids';
    protected $primaryKey = 'id';
    protected $fillable = ['karyawan_id', 'tgl_cek', 'hasil', 'keterangan'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan');
    }
}
