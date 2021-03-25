<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\HasilPerakitanKaryawan;
use App\Karyawan;

class HasilPerakitan extends Model
{
    protected $fillable = ['perakitan_id','tanggal', 'no_seri', 'warna', 'kondisi', 'keterangan'];

    public function Perakitan()
    {
        return $this->belongsTo(Perakitan::class);
    }

    public function HasilPerakitanKaryawan()
    {
        return $this->hasMany(HasilPerakitanKaryawan::class);
    }

    public function Karyawan()
    {
        return $this->belongsToMany(Karyawan::class, 'hasil_perakitan_karyawans')->withPivot('operator_custom')->withTimestamps();
    }
}
