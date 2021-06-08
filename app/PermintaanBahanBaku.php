<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanBahanBaku extends Model
{
    protected $fillable = ['bppb_id', 'divisi_id', 'tanggal', 'jumlah', 'status'];
    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function DetailPermintaanBahanBaku()
    {
        return $this->hasMany(DetailPermintaanBahanBaku::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}
