<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriksaBarangMasuk extends Model
{
    protected $fillable = ['packing_list_id', 'part_id', 'karyawan_id', 'user_id', 'nomor', 'tanggal', 'metode', 'jumlah', 'jumlah_sampling', 'tindak_lanjut', 'keterangan', 'status'];

    public function PackingList()
    {
        return $this->belongsTo(PackingList::class);
    }

    public function Part()
    {
        return $this->belongsTo(Part::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
