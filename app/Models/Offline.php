<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offline extends Model
{
    protected $table = 'offlines';
    protected $primaryKey = 'id';
    protected $fillable = ['order_id', 'customer_id', 'status', 'bayar'];

    public function distributor()
    {
        return $this->belongsTo('App\Distributor', 'customer_id');
    }

    public function penawaran_offline()
    {
        return $this->hasOne('App\Penawaran_Offline', 'id');
    }

    public function podo_offline()
    {
        return $this->hasOne('App\Podo_offline', 'id');
    }
}
