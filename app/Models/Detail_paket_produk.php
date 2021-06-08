<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_paket_produk extends Model
{
    protected $tables = 'detail_paket_produks';
    protected $primaryKey = 'id';
    protected $fillable = ['paket_produk_id','produk_id','jumlah'];

 


}   

