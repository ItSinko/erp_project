<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoPembelian extends Model
{
    protected $fillable = ['id', 'supplier_id', 'nomor', 'status'];

    public function PackingList()
    {
        return $this->hasMany(PackingList::class);
    }
}
