<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListIkPemeriksaan extends Model
{
    protected $fillable = ['ik_pemeriksaan_id', 'pemeriksaan'];

    public function IkPemeriksaan()
    {
        return $this->belongsTo(IkPemeriksaan::class);
    }

    public function DetailIkPemeriksaan()
    {
        return $this->hasMany(DetailIkPemeriksaan::class);
    }
}
