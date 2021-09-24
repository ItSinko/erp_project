<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Perakitan;
use App\Pengemasan;
use App\DetailProduk;
use App\Divisi;
use App\HasilMonitoringProses;
use App\HasilIkPemeriksaanPengujian;

class Bppb extends Model
{
    protected $fillable = ['detail_produk_id', 'versi_bom', 'no_bppb', 'tanggal_bppb', 'divisi_id', 'jumlah'];

    public function DetailProduk()
    {
        return $this->belongsTo(DetailProduk::class);
    }

    public function Divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function Perakitan()
    {
        return $this->hasMany(Perakitan::class);
    }

    public function countHasilPerakitan()
    {
        $count = 0;
        $k = $this->Perakitan;

        foreach ($k as $l) {
            $m = Perakitan::find($l->id);
            $count = $count + $m->HasilPerakitan->count();
        }

        return $count;
    }

    public function Pengemasan()
    {
        return $this->hasMany(Pengemasan::class);
    }

    public function countHasilPengemasan()
    {
        $count = 0;
        $k = $this->Pengemasan;

        foreach ($k as $l) {
            $m = HasilPengemasan::where('pengemasan_id', $l->id)->count();
            $count = $count + $m;
        }

        return $count;
    }

    public function countRencanaPengemasan()
    {
        $count = 0;
        $k = $this->MonitoringProses;

        foreach ($k as $l) {
            $m = HasilMonitoringProses::where(
                [
                    ['status', '=', 'pengemasan'],
                    ['monitoring_proses_id', '=', $l->id]
                ]
            )->count();
            $count = $count + $m;
        }
        return $count;
    }

    public function PemeriksaanProsesPengujian()
    {
        return $this->hasMany(PemeriksaanProsesPengujian::class);
    }

    public function MonitoringProses()
    {
        return $this->hasMany(MonitoringProses::class);
    }

    public function countPemeriksaanProses($id)
    {
        $c = 0;
        $mp = $this->MonitoringProses;
        foreach ($mp as $i) {
            $s = HasilMonitoringProses::whereHas('HasilIkPemeriksaanPengujian', function ($q) use ($id) {
                $q->where('id', $id);
            })->where('monitoring_proses_id', $i->id)->count();
            $c = $c + $s;
        }
        return $c;
    }

    public function countMonitoringProses()
    {
        $c = 0;
        $mp = $this->MonitoringProses;
        foreach ($mp as $i) {
            $s = HasilMonitoringProses::where('monitoring_proses_id', $i->id)->distinct()->get('hasil_perakitan_id')->count();
            $c = $c + $s;
        }
        return $c;
    }

    public function countHasilPengemasanByHasil($hasil)
    {
        $c = 0;
        $p = $this->Pengemasan;
        foreach ($p as $i) {
            $s = HasilPengemasan::where([
                ['pengemasan_id', '=', $i->id],
                ['hasil', '=', $hasil]
            ])->whereHas('HasilPerakitan', function ($q) {
                $q->doesntHave('DetailPenyerahanBarangJadi');
            })->count();
            $c = $c + $s;
        }
        return $c;
    }

    public function PerbaikanProduksi()
    {
        return $this->hasMany(PerbaikanProduksi::class);
    }

    public function PersiapanPackingProduk()
    {
        return $this->hasMany(PersiapanPackingProduk::class);
    }

    public function PermintaanBahanBaku()
    {
        return $this->hasMany(PermintaanBahanBaku::class);
    }

    public function PengembalianBarangGudang()
    {
        return $this->hasMany(PengembalianBarangGudang::class);
    }

    public function PenyerahanBarangJadi()
    {
        return $this->hasMany(PenyerahanBarangJadi::class);
    }

    public function Kalibrasi()
    {
        return $this->hasMany(Kalibrasi::class);
    }

    public function PemeriksaanProses()
    {
        return $this->hasMany(PemeriksaanProses::class);
    }
}
