<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podo_offline extends Model
{
    protected $table = 'podo_offlines';
    protected $primaryKey = 'id';
    protected $fillable = ['offline_id', 'po', 'tglpo', 'do', 'tgldo', 'file', 'keterangan'];

    public function Offline()
    {
        return $this->BelongsTo('App\Offline', 'offline_id');
    }
}
