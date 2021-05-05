<?php

namespace App\digidocu;

use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    protected $table = 'shared';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
