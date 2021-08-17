<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartGudangPartEng extends Model
{
    protected $fillable = ['kode_gudang', 'kode_eng'];

    public function toPartGudang()
    {
        return $this->belongsTo(Part::class, 'kode_gudang', 'kode');
    }

    public function toPartEng()
    {
        return $this->belongsTo(PartEng::class, 'kode_eng' . 'kode_part');
    }
}
