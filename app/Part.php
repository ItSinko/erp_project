<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = ['nama', 'kode_eng', 'kode_gudang', 'jumlah', 'foto'];

    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class);
    }
}
