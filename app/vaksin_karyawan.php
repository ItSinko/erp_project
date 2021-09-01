<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vaksin_karyawan extends Model
{
    protected $table = 'vaksin_karyawans';
    protected $fillable = ['karyawan_id', 'tgl', 'dosis', 'tahap'];

    public function Karyawan()
    {
        return $this->belongsTo('App\Karyawan', 'karyawan_id');
    }
}
