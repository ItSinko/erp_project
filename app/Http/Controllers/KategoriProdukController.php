<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriProduk;

class KategoriProdukController extends Controller
{
    public function show_all()
    {
        $s = KategoriProduk::all();
        return $s;
    }

    public function show_by_produk($produk_id)
    {
        $s = KategoriProduk::leftjoin('produks', function($join) {
                $join->on('kategori_produks.id', '=', 'produks.kategori_id');
            })
            ->select('kategori_produks.id as kategori_id', 
                    'kategori_produks.nama as nama_kategori')
            ->where('produks.id', '=', $produk_id)
            ->get();
        
        return $s;
    }

    public function show_by_kelompok($kelompok_produk_id)
    {
        $s = KategoriProduk::leftjoin('kelompok_produks', function($join) {
                $join->on('kategori_produks.kelompok_produk_id', '=', 'kelompok_produks.id');
            })
            ->select('kelompok_produks.id as kelompok_produk_id', 
                    'kelompok_produks.nama as nama_kelompok_produk', 
                    'kategori_produks.id as kategori_id', 
                    'kategori_produks.nama as nama_kategori')
            ->where('kelompok_produks.id', '=', $kelompok_produk_id)
            ->get();
        
        return $s;
    }


}
