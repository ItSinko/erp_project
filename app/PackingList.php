<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackingList extends Model
{
    protected $fillable = ['po_id', 'nomor', 'tanggal', 'status'];

    public function PoPembelian()
    {
        return $this->belongsTo(PoPembelian::class, 'po_id');
    }

    public function DetailPackingList()
    {
        return $this->hasMany(DetailPackingList::class);
    }
}
