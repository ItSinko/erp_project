<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HasilPerakitanKaryawan;
use App\HasilPerakitan;
use App\DivisiInventory;

class Karyawan extends Model
{
    protected $fillable = ['nama', 'divisi_id', 'jabatan', 'foto'];
    public function HasilPerakitanKaryawan()
    {
        return $this->hasMany(HasilPerakitanKaryawan::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsToMany(HasilPerakitan::class, 'hasil_perakitan_karyawans')->withPivot('operator_custom');
    }

    public function DivisiInventory()
    {
        return $this->hasOne(DivisiInventory::class);
    }

    public function PeminjamanKaryawan()
    {
        return $this->hasMany(PeminjamanKaryawan::class, 'penanggung_jawab_id');
    }

    public function DetailPeminjamanKaryawan()
    {
        return $this->hasMany(DetailPeminjamanKaryawan::class);
    }
}
