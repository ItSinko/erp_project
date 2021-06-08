<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartGudangPartEng extends Model
{
    protected $fillable = ['kode_gudang', 'kode_eng'];

    public function part_gudang()
    {
        return $this->belongsTo(Part::class, 'kode_gudang', 'kode');
    }
}
