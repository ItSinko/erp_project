<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_ekatjual extends Model
{
    protected $table = 'detail_ekatjuals';
    protected $primaryKey = 'id';
    protected $fillable = ['ekatjual_id', 'produk_id', 'harga', 'jumlah'];
}
