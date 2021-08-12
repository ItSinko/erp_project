<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['id', 'klasifikasi', 'kode', 'nama'];
    public function PoPembelian()
    {
        return $this->hasMany(PoPembelian::class);
    }
}
