<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $primaryKey = "kode";
    protected $fillable = ['nama', 'kode', 'jumlah', 'foto'];

    protected $keyType = "string";
    public $incrementing = false;

    public function toPartGudangPartEng()
    {
        return $this->hasMany(PartGudangPartEng::class, 'kode_gudang');
    }

    public function toPartEng()
    {
        return $this->belongsToMany(PartEng::class, 'part_gudang_part_engs', 'kode_gudang', 'kode_eng', 'kode', 'kode_part');
    }
}
