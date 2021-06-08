<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bom_Version extends Model
{
    protected $table = 'produk_bill_of_materials';
    protected $fillable = ['detail_produk_id', 'versi'];
}
