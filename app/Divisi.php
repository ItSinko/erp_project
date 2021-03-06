<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\DivisiInventory;

class Divisi extends Model
{
    protected $fillable = ['nama', 'kode'];

    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function DivisiInventory()
    {
        return $this->hasOne(DivisiInventory::class);
    }
    public function Karyawan()
    {
        return $this->hasMany('App\Karyawan');
    }

    public function PenyerahanBarangJadi()
    {
        return $this->hasMany(PenyerahanBarangJadi::class);
    }

    public function PermintaanBahanBaku()
    {
        return $this->hasMany(PermintaanBahanBaku::class);
    }

    public function GudangProduk()
    {
        return $this->hasMany(GudangProduk::class);
    }

    public function MutasiGudangProduk()
    {
        return $this->hasMany(MutasiGudangProduk::class);
    }
}
