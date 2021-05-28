<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyerahanBarangJadi extends Model
{
    protected $fillable = ['bppb_id', 'divisi_id', 'tanggal', 'jumlah', 'status'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function DetailPenyerahanBarangJadi()
    {
        return $this->hasMany(DetailPenyerahanBarangJadi::class);
    }
}
