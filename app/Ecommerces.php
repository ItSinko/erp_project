<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ecommerces extends Model
{
    protected $table = 'ecommerces';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'market', 'customer_id', 'status', 'bayar'];

    public function distributor()
    {
        return $this->belongsTo('App\Distributor', 'customer_id');
    }
}
