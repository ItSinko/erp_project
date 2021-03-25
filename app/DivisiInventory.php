<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Divisi;
use App\Karyawan;
use App\Inventory;

class DivisiInventory extends Model
{
    protected $fillable = ['kode', 'divisi_id', 'pic_id'];

    public function Inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'pic_id');
    }
}
