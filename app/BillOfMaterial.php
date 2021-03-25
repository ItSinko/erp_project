<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillOfMaterial extends Model
{
    protected $fillable = ['produk_id', 'part_id', 'jumlah'];
    
    public function Produk()
    {
        $this->belongsTo(Produk::class);
    }

    public function Part()
    {
        $this->belongsTo(Part::class);
    }
}
