<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DivisiInventory;
use App\User;

class PeminjamanAlat extends Model
{
    protected $fillable = ['divisi_inventory_id', 'inventory_id', 'jumlah', 'peminjam_id', 'tanggal_pengajuan', 'tanggal_peminjaman', 'tanggal_batas_pengembalian', 'tanggal_perpanjangan', 'tanggal_kembali', 'keterangan', 'status'];

    public function DivisiInventory()
    {
        return $this->belongsTo(DivisiInventory::class);
    }

    public function Inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'peminjam_id');
    }
}
