<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Events\Notification;
use Yajra\DataTables\Facades\DataTables;

use App\User;
use App\Bill_of_material;
use App\Produk;
use App\Part;
use App\Bppb;
use App\KelompokProduk;

class PPICController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.ppic.jadwal_produksi');
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

    public function bppb()
    {
        return view('page.ppic.bppb_show');
    }

    public function bppb_show()
    {
        $b = Bppb::all();
        return DataTables::of($b)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<div class="text-center">';
                $gambar .= '<img class="product-img-small img-fluid"';
                if (empty($s->produk->foto)) {
                    $gambar .= `src="{{url('assets/image/produk')}}/noimage.png"`;
                } else if (!empty($s->foto)) {
                    $gambar = `src="{{asset('image/produk/')}}/{{` . $s->produk->foto . `}}"`;
                }

                $gambar .= `title="` . $s->produk->nama . `">`;
                return $gambar;
            })
            ->editColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->produk->tipe . ' - ' . $s->produk->nama . '</h6><div class="subheading text-muted">' . $s->produk->kelompokproduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">';
                $btn .= '<i class="fa fa-ellipsis-v" aria-hidden="true"></i> </a>';

                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item" href="/bppb/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/bppb/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->editColumn('divisi_id', function ($s) {
                $btn = $s->Divisi->nama;
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'aksi'])
            ->make(true);
        return view('page.ppic.bppb_show', ['b' => $b]);
    }

    public function bppb_create()
    {
        $k = KelompokProduk::all();
        return view('page.ppic.bppb_create', ['k' => $k]);
    }

    public function bppb_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'produk_id' => 'required',
                'divisi_id' => 'required',
                'no_bppb_urutan' => 'required',
                'no_bppb_kode' => 'required',
                'no_bppb_tahun' => 'required',
                'no_bppb_bulan' => 'required',
                'jumlah' => 'required',
                'tanggal_bppb' => 'required',
            ],
            [
                'produk_id.required' => "Silahkan Pilih Produk",
                'divisi_id.reqired' => "Silahkan Pilih Divisi",
                'jumlah.required' => "Jumlah Harus Diisi",
                'tanggal_bppb.required' => "Tanggal Harus Diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $no_bppb = $request->no_bppb_urutan . '/' . $request->no_bppb_kode . '/' . $request->no_bppb_bulan . '/' . $request->no_bppb_tahun;
            $c = Bppb::create([
                'no_bppb' => $no_bppb,
                'produk_id' => $request->produk_id,
                'divisi_id' => $request->divisi_id,
                'tanggal_bppb' => $request->tanggal_bppb,
                'jumlah' => $request->jumlah
            ]);

            if ($c) {
                $u = User::where('divisi_id', $request->divisi_id)->get();
                foreach ($u as $i) {
                    $cs = $this->NotifikasiController->create("Penambahan BPPB", "telah menambahkan BPPB", Auth::user()->id, $i->id, "/bppb");
                }
                return redirect()->back()->with('success', "Berhasil menambahkan BPPB");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan BPPB");
            }
        }
    }

    public function bppb_edit($id)
    {
        $b = Bppb::find($id);
        $k = KelompokProduk::all();
        $p = Produk::all();

        $no_bppb = explode("/", $b->no_bppb);
        return view('page.ppic.bppb_edit', ['id' => $id, 'i' => $b, 'no_bppb' => $no_bppb, 'k' => $k, 'p' => $p]);
    }

    public function bppb_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'produk_id' => 'required',
                'divisi_id' => 'required',
                'no_bppb_urutan' => 'required',
                'no_bppb_kode' => 'required',
                'no_bppb_tahun' => 'required',
                'no_bppb_bulan' => 'required',
                'jumlah' => 'required',
                'tanggal_bppb' => 'required',
            ],
            [
                'produk_id.required' => "Silahkan Pilih Produk",
                'divisi_id.reqired' => "Silahkan Pilih Divisi",
                'jumlah.required' => "Jumlah Harus Diisi",
                'tanggal_bppb.required' => "Tanggal Harus Diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $no_bppb = $request->no_bppb_urutan . '/' . $request->no_bppb_kode . '/' . $request->no_bppb_bulan . '/' . $request->no_bppb_tahun;

            $u = Bppb::find($id);
            $u->no_bppb = $no_bppb;
            $u->produk_id = $request->produk_id;
            $u->divisi_id = $request->divisi_id;
            $u->tanggal_bppb = $request->tanggal_bppb;
            $u->jumlah = $request->jumlah;
            $up = $u->save();

            if ($up) {
                return redirect()->back()->with('success', "Berhasil menambahkan BPPB");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan BPPB");
            }
        }
    }

    public function bppb_delete($id, Request $request)
    {
        $bppb = Bppb::find($id);
        $this->UserLogController->create(Auth::user()->id, $bppb->no_bppb, 'BPPB', 'Hapus', $request->keterangan_log);
        $d = $bppb->delete();

        return redirect()->back();
    }
}
