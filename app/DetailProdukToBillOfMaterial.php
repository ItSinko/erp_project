<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProdukToBillOfMaterial extends Model
{
    protected $table = 'produk_bill_of_materials';
    protected $fillable = ['detail_produk_id', 'versi'];

    public function BillOfMaterial()
    {
        return $this->hasMany(BillOfMaterial::class, 'produk_bill_of_material_id');
    }
}
