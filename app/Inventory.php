<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DivisiInventory;
use Carbon\Carbon;
use App\PeminjamanAlat;

class Inventory extends Model
{
    protected $fillable = ['divisi_inventory_id', 'kode_barang', 'nama_barang', 'lokasi', 'merk', 'jumlah', 'tanggal_perolehan', 'masa_manfaat', 'kondisi', 'harga_perolehan', 'keterangan', 'status'];
    public function DivisiInventory()
    {
        return $this->belongsTo(DivisiInventory::class);
    }

    public function PeminjamanAlat()
    {
        return $this->hasMany(PeminjamanAlat::class);
    }

    public function nilai_penyusutan()
    {
        return round(($this->harga_perolehan * $this->jumlah) / ($this->masa_manfaat * 12));
    }

    public function akum_nilai_penyusutan()
    {
        $date = Carbon::parse($this->tanggal_perolehan);
        $now = Carbon::now();
        $jumlah_bulan = $date->diffInDays($now);
        return round($this->harga_perolehan * $this->jumlah) / (($this->masa_manfaat * 12) * ($jumlah_bulan * 1));
    }

    public function nilai_sisa_buku()
    {
        return round($this->harga_perolehan - ($this->akum_nilai_penyusutan($this->harga_perolehan, $this->jumlah, $this->masa_manfaat, $this->tanggal_perolehan)));
    }
}
