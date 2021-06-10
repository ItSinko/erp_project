<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\BillOfMaterial;

class ProdukBillOfMaterial extends Model
{
    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class);
    }
}
