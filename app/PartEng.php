<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartEng extends Model
{
    protected $primaryKey = "kode_part";
    protected $fillable = ['kode_part', 'nama', 'foto', 'deskripsi', 'spesifikasi', 'status'];

    protected $keyType = "string";
    public $incrementing = false;

    public function toPartGudangPartEng()
    {
        return $this->hasMany(PartGudangPartEng::class, 'kode_eng');
    }

    public function toPartGudang()
    {
        return $this->belongsToMany(Part::class, 'part_gudang_part_engs', 'kode_eng', 'kode_gudang', 'kode_part', 'kode');
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
