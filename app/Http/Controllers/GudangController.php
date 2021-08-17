<?php

namespace App\Http\Controllers;

use App\DetailProduk;
use App\DetailProdukToBillOfMaterial;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Part;
use App\Event;
use App\PartGudangPartEng;
use App\ProdukBillOfMaterial;

class GudangController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        $event = Event::where('status', 'permintaan')->get();

        $result = [];
        foreach ($event as $e) {
            $bom = ProdukBillOfMaterial::where('versi', $e->versi_bom)->where('detail_produk_id', $e->detail_produk_id)->first();
            array_push($result, $bom);
        }
        // return view('page.gudang.gudang', compact('result'));
        return $result;
    }

    public function part()
    {
        return view('page.gbmp.part_show');
    }

    public function data_part()
    {
        $data = Part::all();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function input_form()
    {
        $part_gudang = Part::all();
        return view("page.gbmp.form_gudang", ['data_product' => $part_gudang]);
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
