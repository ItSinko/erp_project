<?php

namespace App\Http\Controllers;

use App\KartuStockGbj;
use App\HasilPerakitan;
use App\DetailProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PDF;

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
}
