<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCekPengemasan extends Model
{
    protected $fillable = ['cek_pengemasan_id', 'nama_barang'];

    public function CekPengemasan()
    {
        return $this->belongsTo(CekPengemasan::class);
    }

    public function HasilPengemasan()
    {
        return $this->belongsToMany(HasilPengemasan::class, 'hasil_pengemasan_detail_cek_pengemasans', 'detail_cek_id', 'hasil_id')->withTimestamps();
    }
}
