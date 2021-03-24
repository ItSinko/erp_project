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
}
