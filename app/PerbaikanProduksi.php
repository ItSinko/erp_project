<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerbaikanProduksi extends Model
{
    protected $fillable = ['bppb_id', 'karyawan_id', 'kondisi_produk', 'ketidaksesuaian_proses', 'sebab_ketidaksesuaian', 'tanggal_permintaan', 'nomor', 'tanggal_pengerjaan', 'analisa', 'realisasi_pengerjaan', 'status'];

    public function Bppb()
    {
        return $this->belongsTo(Bppb::class);
    }

    public function Karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function HasilPerakitan()
    {
        return $this->belongsToMany(HasilPerakitan::class, 'perbaikan_produksi_perakitans')->withTimestamps();
    }

    public function HasilMonitoringProses()
    {
        return $this->belongsToMany(HasilMonitoringProses::class, 'perbaikan_produksi_pengujians')->withTimestamps();
    }

    public function HasilPengemasan()
    {
        return $this->belongsToMany(HasilPengemasan::class, 'perbaikan_produksi_pengemasans')->withTimestamps();
    }

    public function PartEng()
    {
        return $this->belongsToMany(PartEng::class, 'perbaikan_produksi_parts', 'perbaikan_produksi_id', 'part_id')->withTimestamps();
    }
}