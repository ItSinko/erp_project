<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengemasan extends Model
{
    protected $fillable = ['bppb_id', 'pic_id', 'tanggal', 'status'];
    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'pic_id');
    }
}
