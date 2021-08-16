<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPackingList extends Model
{
    protected $fillable = ['packing_list_id', 'kode_barang', 'nama_barang', 'jumlah'];

    public function PackingList()
    {
        return $this->belongsTo(PackingList::class);
    }
}
