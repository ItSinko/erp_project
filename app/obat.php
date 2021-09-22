<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    protected $table = 'obats';
    protected $fillable = ['nama', 'stok', 'keterangan'];

    public function karyawan_sakit()
    {
        return $this->hasMany('App\karyawan_sakit');
    }
    public function karyawan_masuk()
    {
        return $this->hasMany('App\karyawan_masuk');
    }
    public function detail_obat()
    {
        return $this->hasMany('App\detail_obat');
    }
}
