<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengecekanIncomingPart extends Model
{
    protected $fillable = ['packing_list_id', 'karyawan_id', 'tanggal_pemeriksaan', 'metode', 'status'];

    public function PackingList()
    {
        return $this->belongsTo(PackingList::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
