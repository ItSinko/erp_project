<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOfMaterial extends Model
{
    protected $fillable = ['detail_produk_id', 'part_eng_id', 'jumlah', 'satuan', 'status'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function PartEng()
    {
        return $this->belongsTo(PartEng::class);
    }
}
