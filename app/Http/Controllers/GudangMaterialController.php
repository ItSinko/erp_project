<?php

namespace App\Http\Controllers;

use App\DetailProduk;
use App\Divisi;
use App\Event;
use Illuminate\Http\Request;
use App\Part;
use App\ProdukBillOfMaterial;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class GudangMaterialController extends Controller
{
    // API
    public function getData()
    {
        $data = Part::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function getBom($id)
    {
        return ProdukBillOfMaterial::where('produk_bill_of_materials.id', $id)
            ->join('bill_of_materials', 'produk_bill_of_materials.id', 'bill_of_materials.produk_bill_of_material_id')
            ->join('part_gudang_part_engs', 'bill_of_materials.part_eng_id', 'part_gudang_part_engs.kode_eng')
            ->join('parts', 'part_gudang_part_engs.kode_gudang', 'parts.kode')
            ->join('part_engs', 'part_gudang_part_engs.kode_eng', 'part_engs.kode_part')
            ->select('part_gudang_part_engs.id as id', 'parts.nama as nama_gudang', 'parts.kode as kode_gudang', 'part_engs.nama as nama_eng', 'part_engs.kode_part as kode_eng', 'bill_of_materials.jumlah as jumlah')->get();
    }

    public function getBppb()
    {
        $event = Event::with("DetailProduk")->get();
        foreach ($event as $d) {
            $d['bom'] = $this->getBom($d->produk_bill_of_material_id);
        }
        return $event;
    }
    // End of API


    public function showData()
    {
        return view('page.gbmp.data_gudang');
    }

    public function showOrder()
    {
        $data = $this->getBppb();
        return view('page.gbmp.part_order', compact('data'));
    }

    public function getBomTable($id)
    {
        $bom = $this->getBom($id);
        return DataTables::of($bom)
            ->addIndexColumn()
            ->make(true);
    }

    public function getExampleData()
    {
        $data = DB::table('tws')->get();
        return $data;
        // return DataTables::of($data)
        //     ->make(true);
    }
}
