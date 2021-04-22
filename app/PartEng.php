<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartEng extends Model
{
    protected $fillable = ['part_id', 'kode_part', 'nama', 'foto', 'deskripsi', 'spesifikasi', 'status'];

    public function Part()
    {
        return $this->belongsTo(Part::class);
    }

    public function BillOfMaterial()
    {
        $this->hasMany(BillOfMaterial::class);
    }
}
