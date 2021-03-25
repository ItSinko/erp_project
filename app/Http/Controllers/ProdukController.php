<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;

class ProdukController extends Controller
{
    public function show_all()
    {
        $s = Produk::leftJoin('kelompok_produks', function($join) {
            $join->on('produks.kelompok_produk_id', '=', 'kelompok_produks.id');
        })
        ->leftJoin('kategori_produks', 'produks.kategori_id', '=', 'kategori_produks.id')
        ->select('produks.id as id',
                'kelompok_produks.nama as nama_kelompok_produk',
                'kelompok_produks.id as kelompok_produk_id',
                'kategori_produks.nama as nama_kategori',
                'kategori_produks.id as kategori_id',
                'produks.merk as merk',
                'produks.tipe as tipe',
                'produks.nama as nama',
                'produks.foto as foto',
                'produks.kode as kode',
                'produks.kode_barcode as kode_barcode',
                'produks.berat as berat',
                'produks.satuan as satuan',
                'produks.nama_coo as nama_coo',
                'produks.no_akd as no_akd',
                'produks.keterangan as keterangan')
        ->get();
        return $s;
    }

    public function show($id)
    {
        $s = Produk::leftJoin('kelompok_produks', function($join) {
                $join->on('produks.kelompok_produk_id', '=', 'kelompok_produks.id');
            })
            ->leftJoin('kategori_produks', 'produks.kategori_id', '=', 'kategori_produks.id')
            ->select('produks.id as id',
                    'kelompok_produks.nama as nama_kelompok_produk',
                    'kelompok_produks.id as kelompok_produk_id',
                    'kategori_produks.nama as nama_kategori',
                    'kategori_produks.id as kategori_id',
                    'produks.merk as merk',
                    'produks.tipe as tipe',
                    'produks.nama as nama',
                    'produks.foto as foto',
                    'produks.kode as kode',
                    'produks.kode_barcode as kode_barcode',
                    'produks.berat as berat',
                    'produks.satuan as satuan',
                    'produks.nama_coo as nama_coo',
                    'produks.no_akd as no_akd',
                    'produks.keterangan as keterangan')
            ->where('produks.id', '=', $id)
            ->get();

        return $s;
    }

    public function show_tipe_exist($tipe)
    {
        $s = Produk::where('tipe', '=', $tipe)->count();
        return $s;
    }

    public function show_by_kelompok($kelompok_produk_id)
    {
        $s = Produk::join('kelompok_produks', function($join) {
                $join->on('produks.kelompok_produk_id', '=', 'kelompok_produks.id');
            })
            ->select('produks.id as id',
                    'kelompok_produks.nama as nama_kelompok_produk',
                    'kelompok_produks.id as kelompok_produk_id',
                    'produks.merk as merk',
                    'produks.tipe as tipe',
                    'produks.nama as nama',
                    'produks.foto as foto',
                    'produks.kode as kode',
                    'produks.kode_barcode as kode_barcode',
                    'produks.berat as berat',
                    'produks.satuan as satuan',
                    'produks.nama_coo as nama_coo',
                    'produks.no_akd as no_akd',
                    'produks.keterangan as keterangan')
            ->where('produks.kelompok_produk_id', '=', $kelompok_produk_id)
            ->get();
        return $s;
    }

    public function show_by_kategori($kategori_id)
    {
        $s = Produk::leftJoin('kategori_produks', function($join) {
            $join->on('produks.kategori_id', '=', 'kategori_produks.id');
        })
        ->select('produks.id as id',
                'kategori_produks.nama as nama_kategori',
                'kategori_produks.id as kategori_id',
                'produks.merk as merk',
                'produks.tipe as tipe',
                'produks.nama as nama',
                'produks.foto as foto',
                'produks.kode as kode',
                'produks.kode_barcode as kode_barcode',
                'produks.berat as berat',
                'produks.satuan as satuan',
                'produks.nama_coo as nama_coo',
                'produks.no_akd as no_akd',
                'produks.keterangan as keterangan')
        ->where('produks.kategori_id', '=', $kategori_id)
        ->get();
        return $s;
    }

    public function create($kelompok_produk_id, $kategori_id, $merk, $tipe, $nama, $foto, $kode, $kode_barcode, $berat, $satuan, $nama_coo, $no_akd, $harga, $keterangan)
    {
        $c = Produk::create([
                'kelompok_produk_id' => $kelompok_produk_id,
                'kategori_id' => $kategori_id,
                'merk' => $merk,
                'tipe' => $tipe,
                'nama' => $nama,
                'foto' => $foto,
                'kode' => $kode,
                'kode_barcode' => $kode_barcode,
                'berat' => $berat,
                'satuan' => $satuan,
                'nama_coo' => $nama_coo,
                'no_akd' => $no_akd,
                'harga' => $harga,
                'keterangan' => $keterangan
            ]);
        return $c; 
    }
}
