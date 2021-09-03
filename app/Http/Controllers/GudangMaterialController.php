<?php

namespace App\Http\Controllers;

use App\DetailProduk;
use App\Divisi;
use App\Event;
use Illuminate\Http\Request;
use App\Part;
use App\ProdukBillOfMaterial;
use App\User;

class GudangMaterialController extends Controller
{
    public function getData()
    {
        return Part::select('kode', 'nama')->get();
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
}
