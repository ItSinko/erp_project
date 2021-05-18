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
use App\DetailProduk;
use App\Produk;
use App\Part;
use App\Bppb;
use App\KelompokProduk;
use App\Event;

class PPICController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date = Event::toBase()->orderBy('start', 'asc')->get();
        $event = json_encode($date);
        $produk = Produk::select('nama')->get();
        $arr = [];
        $today = date('m');
        foreach ($date as $d) {
            $temp = strtotime($d->start);
            if ($today == date('m', $temp)) {
                array_push($arr, $d);
            }
        }
        $date = $arr;
        return view('page.ppic.jadwal_produksi', compact('event', 'produk', 'date'));
    }

    public function ppic()
    {
        $list = Produk::toBase()->get();
        return view("ppic.form_ppic", compact('list'));
    }

    public function calendar_create(Request $request)
    {
        $data = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ];

        Event::create($data);
        $result = Event::latest()->first();
        return $result;
    }

    public function calendar_delete(Request $request)
    {
        if ($request->id != "") Event::destroy($request->id);
    }

    public function bom()
    {
        $list = Produk::all();
        return view('page.ppic.bom', compact('list'));
    }

    public function get_bom()
    {
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
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar = 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }

                $gambar .= `title="` . $s->DetailProduk->nama . `">`;
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->Kelompokproduk->nama . '</div></hgroup>';
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
                'detail_produk_id' => 'required',
                'divisi_id' => 'required',
                'no_bppb_urutan' => 'required',
                'no_bppb_kode' => 'required',
                'no_bppb_tahun' => 'required',
                'no_bppb_bulan' => 'required',
                'jumlah' => 'required',
                'tanggal_bppb' => 'required',
            ],
            [
                'detail_produk_id.required' => "Silahkan Pilih Produk",
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
                'detail_produk_id' => $request->detail_produk_id,
                'divisi_id' => $request->divisi_id,
                'tanggal_bppb' => $request->tanggal_bppb,
                'jumlah' => $request->jumlah
            ]);

            if ($c) {
                // $u = User::where('divisi_id', $request->divisi_id)->get();
                // foreach ($u as $i) {
                //     $cs = $this->NotifikasiController->create("Penambahan BPPB", "telah menambahkan BPPB", Auth::user()->id, $i->id, "/bppb");
                // }
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
        $dp = DetailProduk::all();

        $no_bppb = explode("/", $b->no_bppb);
        return view('page.ppic.bppb_edit', ['id' => $id, 'i' => $b, 'no_bppb' => $no_bppb, 'k' => $k, 'dp' => $dp]);
    }

    public function bppb_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'detail_produk_id' => 'required',
                'divisi_id' => 'required',
                'no_bppb_urutan' => 'required',
                'no_bppb_kode' => 'required',
                'no_bppb_tahun' => 'required',
                'no_bppb_bulan' => 'required',
                'jumlah' => 'required',
                'tanggal_bppb' => 'required',
            ],
            [
                'detail_produk_id.required' => "Silahkan Pilih Produk",
                'divisi_id.required' => "Silahkan Pilih Divisi",
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
            $u->detail_produk_id = $request->detail_produk_id;
            $u->divisi_id = $request->divisi_id;
            $u->tanggal_bppb = $request->tanggal_bppb;
            $u->jumlah = $request->jumlah;
            $up = $u->save();

            if ($up) {
                return redirect()->back()->with('success', "Berhasil mengubah BPPB");
            } else {
                return redirect()->back()->with('error', "Gagal mengubah BPPB");
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
