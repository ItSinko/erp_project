<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Events\TambahBppb;

use DB;
use App\Bppb;
use App\Produk;
use Carbon\Carbon;

class BppbController extends Controller
{
    public function show_all()
    {
        $s = Bppb::leftJoin('produks', function ($join) {
            $join->on('bppbs.produk_id', '=', 'produks.id');
        })
            ->leftJoin('divisis', 'bppbs.divisi_id', '=', 'divisis.id')
            ->leftJoin('kategori_produks', 'produks.kategori_id', '=', 'kategori_produks.id')
            ->leftJoin('kelompok_produks', 'produks.kelompok_produk_id', '=', 'kelompok_produks.id')
            ->select(
                'bppbs.id as id',
                'produks.foto as foto',
                'produks.id as produk_id',
                'produks.tipe as tipe_produk',
                'produks.nama as nama_produk',
                'kelompok_produks.nama as nama_kelompok',
                'kategori_produks.nama as nama_kategori',
                'divisis.id as divisi_id',
                'divisis.nama as nama_divisi',
                'bppbs.no_bppb as no_bppb',
                'bppbs.tanggal_bppb as tanggal_bppb',
                'bppbs.jumlah as jumlah'
            )
            ->get();
        return $s;
    }

    public function show($id)
    {
        $s = Bppb::leftJoin('produks', function ($join) {
            $join->on('bppbs.produk_id', '=', 'produks.id');
        })
            ->leftJoin('divisis', 'bppbs.divisi_id', '=', 'divisis.id')
            ->leftJoin('kategori_produks', 'produks.kategori_id', '=', 'kategori_produks.id')
            ->leftJoin('kelompok_produks', 'produks.kelompok_produk_id', '=', 'kelompok_produks.id')
            ->select(
                'bppbs.id as id',
                'produks.foto as foto',
                'produks.id as produk_id',
                'produks.tipe as tipe_produk',
                'produks.nama as nama_produk',
                'kelompok_produks.id as kelompok_produk_id',
                'kelompok_produks.nama as nama_kelompok',
                'kategori_produks.id as kategori_id',
                'kategori_produks.nama as nama_kategori',
                'divisis.id as divisi_id',
                'divisis.nama as nama_divisi',
                'bppbs.no_bppb as no_bppb',
                'bppbs.tanggal_bppb as tanggal_bppb',
                'bppbs.jumlah as jumlah'
            )
            ->where('bppbs.id', $id)
            ->first();
        return $s;
    }

    public function show_not_in($bppb_id, $divisi_id)
    {
        $s = "";
        if ($divisi_id == NULL) {
            $s = Bppb::whereNotIn('id', $bppb_id)->get();
        } else {
            $s = Bppb::whereNotIn('id', $bppb_id)
                ->where('divisi_id', $divisi_id)
                ->get();
        }
        return $s;
    }

    public function count_produk_by_year($produk, $tahun)
    {
        $tahun1 = $tahun . '-01-01';
        $tahun2 = $tahun . '-12-31';
        $c = Bppb::where('produk_id', $produk)
            ->whereBetween('tanggal_bppb', [$tahun1, $tahun2])
            ->count();

        return $c;
    }

    public function create($produk_id, $divisi_id, $tanggal_bppb, $no_bppb, $jumlah)
    {
        $c = Bppb::create([
            'produk_id' => $produk_id,
            'divisi_id' => $divisi_id,
            'tanggal_bppb' => $tanggal_bppb,
            'no_bppb' => $no_bppb,
            'jumlah' => $jumlah,
            'status' => '12'
        ]);

        return $c;
    }

    public function update($id, $produk_id, $divisi_id, $tanggal_bppb, $no_bppb, $jumlah)
    {
        $u = Bppb::find($id);
        $u->id = $id;
        $u->produk_id = $produk_id;
        $u->divisi_id = $divisi_id;
        $u->tanggal_bppb = $tanggal_bppb;
        $u->no_bppb = $no_bppb;
        $u->jumlah = $jumlah;
        $saved = $u->save();

        return $saved;
    }
}
