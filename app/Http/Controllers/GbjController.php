<?php

namespace App\Http\Controllers;

use App\KartuStockGbj;
use App\DetailKartuStockGbj;
use App\HasilPerakitan;
use App\DetailProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;
use Yajra\DataTables\Contracts\DataTable;

class GbjController extends Controller
{
    public function kartu_stock()
    {
        $p = DetailProduk::all();
        return view('page.gbj.kartu_stock_show', ['p' => $p]);
    }

    public function kartu_stock_show()
    {
        $s = KartuStockGbj::all();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })

            ->addColumn('jumlah', function ($s) {
                $btn = HasilPerakitan::where('perakitan_id', $s->id)->count();
                return $btn . " " . $s->Bppb->DetailProduk->satuan;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/perakitan/pemeriksaan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm karyawan-img-small" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['operator', 'aksi'])
            ->make(true);
    }

    public function kartu_stock_produk($id)
    {
        $k = KartuStockGbj::where('detail_produk_id', $id)->with('DetailProduk')->first();
        return $k;
    }

    public function kartu_stock_produk_show($id)
    {
        $s = DetailKartuStockGbj::whereHas('KartuStockGbj', function ($q) use ($id) {
            $q->where('detail_produk_id', $id);
        })->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->make(true);
    }

    public function kartu_stock_tanggal_show($tanggal)
    {
        $s = DetailKartuStockGbj::where('tanggal', $tanggal)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('nomor', function ($s) {
                return $s->KartuStockGbj->nomor;
            })
            ->addColumn('produk', function ($s) {
                return $s->KartuStockGbj->DetailProduk->nama;
            })
            ->make(true);
    }

    public function kartu_stock_create()
    {
        $p = DetailProduk::doesntHave('KartuStockGbj')->get();
        return view('page.gbj.kartu_stock_create', ['p' => $p]);
    }

    public function kartu_stock_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'nomor' => 'required',
                'tanggal' => 'required',
                'detail_produk_id' => 'required',
            ],
            [
                'nomor.required' => "No Kartu Stok harus diisi",
                'tanggal.required' => "Tanggal harus diisi",
                'detail_produk_id.required' => "Produk harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $s = KartuStockGbj::create([
                'nomor' => $request->nomor,
                'detail_produk_id' => $request->detail_produk_id
            ]);
            $bool = true;
            for ($i = 0; $i < count($request->tanggal); $i++) {
                $d = DetailKartuStockGbj::create([
                    'kartu_stock_id' => $s->id,
                    'tanggal' => $request->tanggal[$i],
                    'jumlah_masuk' => $request->jumlah_masuk[$i],
                    'jumlah_keluar' => $request->jumlah_keluar[$i],
                    'jumlah_saldo' => $request->jumlah_saldo[$i]
                ]);
                if (!$d) {
                    $bool = false;
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', 'Selesai membuat Kartu Stock');
            } else if ($bool == true) {
                return redirect()->back()->with('error', 'Gagal membuat Kartu Stock');
            }
        }
    }
}
