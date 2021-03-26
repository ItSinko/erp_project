<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

use App\Jasa_eks;
use App\Distributor;
use App\Paket_produk;

class CommonController extends Controller
{
    public function jasa_eks()
    {
        return view('page.common.jasa_eks');
    }
    public function jasa_eks_tambah()
    {
        return view('page.common.jasa_eks_tambah');
    }
    public function jasa_eks_ubah()
    {
        return view('page.common.jasa_eks_ubah');
    }
    public function jasa_eks_aksi_tambah()
    {
    }
    public function jasa_eks_data()
    {
        $data = Jasa_eks::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function nama_alamat()
    {
        return view('page.common.nama_alamat');
    }
    public function nama_alamat_tambah()
    {
        return view('page.common.nama_alamat_tambah');
    }
    public function nama_alamat_ubah()
    {
        return view('page.common.nama_alamat_ubah');
    }
    public function nama_alamat_data()
    {
        $data = Distributor::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }




    public function penjualan_produk()
    {
        $data = Paket_produk::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
