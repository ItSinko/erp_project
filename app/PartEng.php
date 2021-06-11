<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartEng extends Model
{
    protected $primaryKey = "kode_part";
    protected $fillable = ['kode_part', 'nama', 'foto', 'deskripsi', 'spesifikasi', 'status'];

    public function PartGudang()
    {
        return $this->hasMany(PartGudangPartEng::class, 'kode_eng');
    }

    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class, 'part_eng_id');
    }

    public function PerbaikanProduksi()
    {
        return $this->belongsToMany(PerbaikanProduksi::class, 'perbaikan_produksi_parts', 'part_id', 'perbaikan_produksi_id')->withTimestamps();
    }
}
