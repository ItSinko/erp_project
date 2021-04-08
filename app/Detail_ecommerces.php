<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_ecommerces extends Model
{
    protected $table = 'detail_ecommerces';
    protected $primaryKey = 'id';
    protected $fillable = ['ecommerces_id', 'produk_id', 'harga', 'jumlah', 'keterangan'];
}
