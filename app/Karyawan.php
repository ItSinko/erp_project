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

    public function Perakitan()
    {
        return $this->belongsToMany(HasilPerakitan::class, 'perakitan_karyawans')->withPivot('operator_custom');
    }

    public function DivisiInventory()
    {
        return $this->hasOne(DivisiInventory::class);
    }

    public function PeminjamanKaryawan()
    {
        return $this->hasMany(PeminjamanKaryawan::class, 'penanggung_jawab_id');
    }

    public function PeminjamanKaryawanKaryawan()
    {
        return $this->belongsToMany(PeminjamanKaryawan::class, 'detail_peminjaman_karyawans')->withPivot('id', 'keterangan', 'status')->withTimestamps();
    }

    public function Penawaran_offline()
    {
        return $this->hasMany('App\Penawaran_offline');
    }

    public function PerbaikanProduksi()
    {
        return $this->hasMany(PerbaikanProduksi::class);
    }

    public function Kesehatan_awal()
    {
        return $this->hasOne('App\Kesehatan_awal');
    }
    public function Kesehatan_harian()
    {
        return $this->hasMany('App\Kesehatan_harian');
    }
    public function Divisi()
    {
        return $this->belongsTo('App\Divisi');
    }
    public function kesehatan_mingguan_rapid()
    {
        return $this->hasMany('App\kesehatan_mingguan_rapid');
    }
    public function kesehatan_mingguan_tensi()
    {
        return $this->hasMany('App\kesehatan_mingguan_tensi');
    }
    public function karyawan_sakit()
    {
        return $this->hasMany('App\karyawan_sakit');
    }
    public function karyawan_masuk()
    {
        return $this->hasMany('App\karyawan_masuk');
    }


    // public function DetailPeminjamanKaryawan()
    // {
    //     return $this->hasMany(DetailPeminjamanKaryawan::class);
    // }
}
