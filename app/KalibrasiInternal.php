<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KalibrasiInternal extends Model
{
    protected $fillable = ['bppb_id', 'podo_online_id', 'pic_id', 'tanggal_daftar', 'tanggal_permintaan_selesai', 'alias_barcode', 'no_pendaftaran', 'status'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Pic()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }

    public function ListKalibrasiInternal()
    {
        return $this->hasMany(ListKalibrasiInternal::class);
    }
}
