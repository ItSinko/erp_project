<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Notification;

use App\Bill_of_material;
use App\Produk;
use App\Part;

class PPICController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $list = Produk::toBase()->get();
        return view("ppic.bom", compact('list'));
    }
    public function get_bom(Request $request)
    {
        $index = $request->input("value");
        // $list = DB::select("select * from bill_of_materials where produk_id=$index");
        $list = Bill_of_material::where('produk_id', $index)->get();

        
        $table =
            "
        <table id='bom_table'>
            <thead>
                <tr>
                    <th></th>
                    <th>Nama Komponen</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
        ";
        foreach ($list as $d) {
            $data =
                "
            <tr>
                <td> $d->kode_eng </td>
                <td> $d->nama</td>
                <td> $d->jumlah </td>
                <td> $d->satuan </td>
            </tr>
            ";
            $table .= $data;
        }
        $table .=
            "
            </tbody>
        </table>
        ";

        return $table;
    }

    public function ppic()
    {
        $list = Produk::toBase()->get();
        return view("ppic.form_ppic", compact('list'));
    }

    public function count_bom(Request $request)
    {
        $index = $request->input("value");
        // $list = DB::select("select * from bom_produk where id=$index");
        $list = Bill_of_material::where('produk_id', $index)->get();

        $count_max = -1;
        foreach ($list as $d) {
            // $stok = DB::select("select stok from stok_gudang where kode_gudang='$d->kode_gudang'");
            $stok = Part::where('part_id', $d->part_id)->get();
            $count = intdiv($stok[0]->jumlah, $d->jumlah);
            // $count = 0;
            if ($count_max == -1 || $count < $count_max) $count_max = $count;
        }

        return $count_max;
    }

    public function test(Request $request)
    {
        $index = $request->input("value");
        $list = Bill_of_material::where('produk_id', $index)->get();

        $produk = Produk::where('id', $index)->get();
        $table =
            "
        <table id='bom_table'>
            <thead>
                <tr>
                    <th>{$produk[0]->nama}</th>
                    <th>Nama Komponen</th>
                    <th>Jumlah</th>
                    <th>Stok</th>
                    <th>Pembagian</th>
                </tr>
            </thead>
            <tbody>
        ";
        foreach ($list as $d) {
            $stok = Part::where('part_id', $d->part_id)->get();
            $count = intdiv($stok[0]->jumlah, $d->jumlah);
            $data =
                "
            <tr>
                <td> $d->part_id </td>
                <td> $d->nama</td>
                <td> $d->jumlah </td>
                <td> {$stok[0]->jumlah} </td>
                <td> $count </td>
            </tr>
            ";
            $table .= $data;
        }
        $table .=
            "
            </tbody>
        </table>
        ";

        return $table;
    }

    public function fire_notif()
    {
        $user = auth()->user()->nama;
        event(new Notification($user, "test message"));
        return "success";
    }
}
