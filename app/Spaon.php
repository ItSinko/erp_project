<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spaon extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['paket_produk_id','distributor_id','lkpp','ak1','harga','jumlah','ongkir','instansi','satuankerja','status','tglbuat','tgledit','despaket'];

    public function distributor(){
        return $this->belongsTo('App\Dsb');
    }

    public function paket_produk(){
        return $this->belongsTo('App\Paket_produk');
    }

    public function podo_on(){
        return $this->hasOne('App\podo_on');
    }
    
    public function sjon(){
        return $this->hasOne('App\Sjon');
    }

}
