<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    public function BillOfMaterial()
    {
        return $this->belongsTo(BillOfMaterial::class);
    }
}
