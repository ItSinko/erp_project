<?php

namespace App\Http\Controllers;

use App\daftar_part;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;



class GudangMaterialController extends Controller
{
    public function daftar_part()
    {
        return view('page.gbmp.part');
    }
    public function daftar_part_data()
    {
        $data = daftar_part::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function pengeluaran_tambah()
    {
        return view('page.gbmp.pengeluaran_tambah');
    }

}
