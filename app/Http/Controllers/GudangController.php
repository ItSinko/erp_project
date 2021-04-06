<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Part;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.gudang.data_gudang');
    }

    public function get_data()
    {
        $data = Part::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function form_gudang()
    {
        return view("gudang.form_gudang");
    }

    public function submit_form_gudang(Request $request)
    { {
            $request->validate([
                'kode'          => 'required',
                'nama'          => 'required',
                'jumlah'        => 'required|numeric',
            ]);

            Part::create([
                'part_id'       => $request->kode,
                'klasifikasi'   => $request->klasifikasi,
                'nama'          => $request->nama,
                'jumlah'        => $request->jumlah,
                'satuan'        => $request->satuan,
                'layout'        => $request->layout,
            ]);

            return response()->json(['success' => 'Form is successfully submitted!']);
        }
    }
}
