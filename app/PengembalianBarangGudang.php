<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengembalianBarangGudang extends Model
{
    protected $fillable = ['bppb_id', 'divisi_id', 'tanggal', 'status'];
    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function DetailPengembalianBarangGudang()
    {
        return $this->hasMany(DetailPengembalianBarangGudang::class);
    }
}
