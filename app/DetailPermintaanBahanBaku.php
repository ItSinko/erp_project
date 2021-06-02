<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaanBahanBaku extends Model
{
    protected $fillable = ['permintaan_bahan_baku_id', 'part_eng_id', 'jumlah_diminta', 'jumlah_diserahkan'];

    public function PermintaanBahanBaku()
    {
        return $this->belongsTo(PermintaanBahanBaku::class);
    }

    public function PartEng()
    {
        return $this->belongsTo(PartEng::class);
    }
}
