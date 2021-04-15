<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekatjual extends Model
{
    protected $table = 'ekatjuals';
    protected $primaryKey = 'id';
    protected $fillable = ['distributor_id', 'lkpp', 'ak1', 'despaket', 'instansi', 'satuankerja', 'status', 'tglbuat', 'tgledit'];

    public function distributor()
    {
        return $this->belongsTo('App\Distributor', 'distributor_id');
    }
}
