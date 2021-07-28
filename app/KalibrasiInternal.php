<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KalibrasiInternal extends Model
{
    protected $fillable = ['bppb_id', 'tanggal_daftar', 'no_pendaftaran', 'tanggal_req_selesai', 'pic_id', 'status'];

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
