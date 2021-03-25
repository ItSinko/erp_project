<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class podo_on extends Model
{
        protected $primaryKey = 'id';
        protected $fillable = ['spaon_id','nopo','tglpo','nodo','tgldo','ket'];

        public function sjon(){
            return $this->hasMany('App\Sjon');
        }
        public function spaon(){
            return $this->belongsTo('App\Spaon');
        }
        public function paket_produk(){
            return $this->belongsTo('App\Paket_produk');
        }
        public function distributor(){
            return $this->belongsTo('App\Dsb');
        }
        

    
}
