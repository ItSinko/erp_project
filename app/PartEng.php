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
        return $this->hasMany(BillOfMaterial::class);
    }

    public function PerbaikanProduksi()
    {
        return $this->belongsToMany(PerbaikanProduksi::class, 'perbaikan_produksi_parts');
    }
}
