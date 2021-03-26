<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Part;

class GudangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Part::toBase()->get();
        return view('page.gudang.data_gudang', compact('data'));
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
