<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill_of_material extends Model
{
    protected $fillable = [
        'produk_id',
        'part_id',
        'kode_eng',
        'nama',
        'jumlah',
        'satuan'
    ];
}
