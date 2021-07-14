<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalisaBarangMasukPs extends Model
{
    protected $fillable = ['packing_list_id', 'part_id', 'user_id', 'analis_id', 'nomor', 'tanggal', 'jumlah', 'keterangan', 'status'];

    public function PackingList()
    {
        return $this->belongsTo(PackingList::class);
    }

    public function Part()
    {
        return $this->belongsTo(Part::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Analis()
    {
        return $this->belongsTo(Analis::class);
    }
}
