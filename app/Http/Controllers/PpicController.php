<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Events\Notification;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

use App\User;
use App\BillOfMaterial;
use App\DetailProduk;
use App\Produk;
use App\Part;
use App\PartOrder;
use App\Bppb;
use App\DetailPenyerahanBarangJadi;
use App\KelompokProduk;
use App\Event;
use App\PartEng;
use App\HasilPerakitan;

use App\Events\RealTimeMessage;
use App\PenyerahanBarangJadi;
use Carbon\Carbon;
use App\HasilPengemasan;
use App\PermintaanBahanBaku;
use App\DetailPermintaanBahanBaku;
use App\Bom_Version;
use App\Events\SimpleNotifEvent;
use App\GudangProduk;
use App\HistoriMutasiGudangProduk;
use App\MutasiGudangProduk;
use App\PengembalianBarangGudang;
use App\ProdukBillOfMaterial;
use PhpParser\Node\Expr\AssignOp\Div;

class PpicController extends Controller
{
    // Query function
    public function getEvent($status)
    {
        // $month = date('m');
        // $year = date('Y');
        $event = Event::with('DetailProduk')->orderBy('tanggal_mulai', 'asc');
        return $event->get();
    }

    public function schedule_show(Request $request, $status_url)
    {
        $month = date('m');
        $year = date('Y');
        $event = Event::with('DetailProduk')->orderBy('tanggal_mulai', 'asc');
        $status = null;

        if ($status_url == "pelaksanaan") {
            $event = $event->whereYear('tanggal_mulai', $year)->whereMonth('tanggal_mulai', $month)->get();
            $status = 'pelaksanaan';
            foreach ($event as $data) {
                $item = Event::find($data['id']);
                $item->status = "pelaksanaan";
                $item->save();
            }
        } else if ($status_url == "penyusunan") {
            $month += 1;
            $event = $event->where('tanggal_mulai', '>=', "$year-$month-01")->get();
            $status = "penyusunan";
        } else if ($status_url == "selesai") {
            $event = $event->where('tanggal_mulai', '<', "$year-$month-01")->get();
            $status = 'selesai';
            foreach ($event as $data) {
                $item = Event::find($data['id']);
                $item->status = "selesai";
                $item->save();
            }
        }

        $detail_produk = DetailProduk::select('nama', 'id')->get();
        return view('page.ppic.jadwal_produksi', compact('event', 'detail_produk', 'status'));
    }

    public function getVersionBomProduct($id)
    {
        return DetailProduk::with('ProdukBillOfMaterial')->find($id);
    }

    public function schedule_create(Request $request)
    {
        // Create new row
        $request->validate([
            'id_produk' => 'required',
            'bom' => 'required',
            'jumlah' => 'required',
        ]);

        $data = [
            'detail_produk_id' => $request->id_produk,
            'produk_bill_of_material_id' => $request->bom,
            'tanggal_mulai' => $request->start,
            'tanggal_selesai' => $request->end,
            'status' => $request->status,
            'jumlah_produksi' => $request->jumlah,
            'warna' => $request->color,
            'konfirmasi' => 0,
        ];
        Event::create($data);

        return Event::with("ProdukBillOfMaterial", "DetailProduk")->latest()->first();
    }

    public function schedule_delete(Request $request)
    {
        Event::destroy($request->id);
    }

    public function schedule_update(Request $request)
    {
        if (isset($request->confirmation)) {
            if (isset($request->id)) {
                Event::find($request->id)->update(['konfirmasi' => $request->confirmation]);
            } else {
                Event::where('status', $request->status)->update(['konfirmasi' => $request->confirmation]);
            }
            if ($request->confirmation < 3) {
                $data = ["confirmation" => $request->confirmation, "message" => $request->message];
                event(new SimpleNotifEvent(Auth::user(), $data));
            }
        }

        return $request;
    }

    public function add_part_order($bom_id, $quantity)
    {
        $bom = DB::table('bill_of_materials')
            ->where('produk_bill_of_material_id', '=', $bom_id)
            ->join('part_gudang_part_engs', 'bill_of_materials.part_eng_id', '=', 'part_gudang_part_engs.kode_eng')
            ->join('part_engs', 'part_gudang_part_engs.kode_eng', '=', 'part_engs.kode_part')
            ->join('parts', 'part_gudang_part_engs.kode_gudang', '=', 'parts.kode')
            ->select('parts.kode', 'bill_of_materials.jumlah')
            ->get();

        foreach ($bom as $d) {
            $data_order = PartOrder::where('kode', $d->kode);
            if ($data_order->exists()) {
                $current_quantity = $data_order->first()->jumlah;
                $data_order->update(['jumlah' => $current_quantity + $d->jumlah * $quantity]);
            } else {
                PartOrder::create([
                    'kode' => $d->kode,
                    'jumlah' => $d->jumlah * $quantity,
                ]);
            }
        }
        return "done";
    }

    public function delete_part_order($bom_id, $quantity)
    {
        $bom = DB::table('bill_of_materials')
            ->where('produk_bill_of_material_id', '=', $bom_id)
            ->join('part_gudang_part_engs', 'bill_of_materials.part_eng_id', '=', 'part_gudang_part_engs.kode_eng')
            ->join('part_engs', 'part_gudang_part_engs.kode_eng', '=', 'part_engs.kode_part')
            ->join('parts', 'part_gudang_part_engs.kode_gudang', '=', 'parts.kode')
            ->select('parts.kode', 'bill_of_materials.jumlah')
            ->get();

        foreach ($bom as $d) {
            $data_order = PartOrder::where('kode', $d->kode);
            if ($data_order->exists()) {
                $current_quantity = $data_order->first()->jumlah;
                $next_quantity = $current_quantity - $d->jumlah * $quantity;
                if ($next_quantity <= 0) $data_order->delete();
                else $data_order->update(['jumlah' => $next_quantity]);
            }
        }
        return "done";
    }

    public function get_item_bom(Request $request)
    {
        $detail_produk_id = $request->detail_produk_id;
        $versi_bom = $request->versi;

        $id = ProdukBillOfMaterial::where('detail_produk_id', $detail_produk_id)->where('versi', $versi_bom)->first()->id;

        $bom = BillOfMaterial::where('produk_bill_of_material_id', '=', $id)
            ->join('part_gudang_part_engs', 'bill_of_materials.part_eng_id', '=', 'part_gudang_part_engs.kode_eng')
            ->join('part_engs', 'part_gudang_part_engs.kode_eng', '=', 'part_engs.kode_part')
            ->join('parts', 'part_gudang_part_engs.kode_gudang', '=', 'parts.kode')
            ->select('bill_of_materials.id', 'part_engs.nama', 'bill_of_materials.jumlah', 'parts.jumlah as stok', 'parts.kode')
            ->get();

        // Count maximum number of product
        if (isset($request->count)) {
            $max_val = INF;
            foreach ($bom as $data) {
                $part_order = PartOrder::where('kode', $data->kode);
                if ($part_order->exists()) $order = $part_order->first()->jumlah;
                else $order = 0;
                $remainder = $data->stok - $order;
                $result = (int)($remainder / $data->jumlah);
                if ($result < $max_val) $max_val = $result;
            }
            return $result;
        }

        return DataTables::of($bom)
            ->addindexColumn()
            ->make(true);
    }

    public function get_versi_bom(Request $request)
    {
        if ($request->id != NULL) $detail_produk_id = Event::find($request->id)->detail_produk_id;
        else if ($request->detail_produk_id != NULL) $detail_produk_id = $request->detail_produk_id;

        return DetailProduk::where('detail_produks.id', $detail_produk_id)
            ->join('produk_bill_of_materials', 'detail_produk_id', 'detail_produks.id')
            ->select('versi', 'detail_produk_id')
            ->get();
    }

    public function bom()
    {
        $produk = Produk::all();
        $detail_produk = DetailProduk::all();
        $produk_bom = ProdukBillOfMaterial::all();

        return view('page.ppic.bom_show', compact('produk', 'detail_produk', 'produk_bom'));
    }

    public function schedule_event_change_status(Request $request)
    {
        if (isset($request->id)) {
            $item = Event::find($request->id);
            $item->status = $request->status;
            $item->save();

            // Update bppb
            $month = date('m');
            $year = date('Y');
            $no_bppb = "0001" . '/' . "TEST" . $item->detail_produk_id . '/' . $month . '/' . $year;
            $month += 1;
            Bppb::create([
                'no_bppb' => $no_bppb,
                'detail_produk_id' => $item->detail_produk_id,
                'versi_bom' => $item->versi_bom,
                'divisi_id' => $request->divisi_id,
                'tanggal_bppb' => "$year-$month-01",
                'jumlah' => $item->jumlah_produksi
            ]);

            return "done";
        }

        foreach ($request->event as $data) {
            $item = Event::find($data['id']);
            $item->status = "disetujui";
            $item->save();
        }
        $this->schedule_notif($request);
        return "done";
    }

    public function bppb_ppic(Request $request)
    {
        if ($request->pelaksanaan == true) $status = "pelaksanaan";
        if ($request->penyusunan == true) $status = "penyusunan";
        if ($request->selesai == true) $status = "selesai";

        return view('page.ppic.bppb_ppic', compact('status'));
    }

    public function bppb()
    {
        return view('page.ppic.bppb_show');
    }

    public function bppb_show(Request $request)
    {
        $month = date('m');
        $year = date('Y');
        $b = Bppb::orderBy('tanggal_bppb', 'asc');

        if (isset($request->status)) {
            if ($request->status == "pelaksanaan") {
                $b = $b->whereYear('tanggal_bppb', $year)->whereMonth('tanggal_bppb', $month)->get();
            } else if ($request->status == "penyusunan") {
                $month += 1;
                $b = $b->where('tanggal_bppb', '>=', "$year-$month-01")->get();
            } else if ($request->status = "selesai") {
                $b = $b->where('tanggal_bppb', '<', "$year-$month-01")->get();
            }
        } else {
            $b = Bppb::all();
        }

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

                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->Kelompokproduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                if (Auth::user()->Divisi->nama == "PPIC") {
                    $btn = "";
                    $btn .= '<button data-toggle="modal" data-target="#detail_bom" data-detail_produk_id="' . $s->detail_produk_id . '" data-versi_bom="' . $s->versi_bom . '" data-jumlah="' . $s->jumlah . '" class="btn btn-info btn-sm m-1 detail_bom_class" style="border-radius:10%;">Detail</button>  ';
                    return $btn;
                }

                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">';
                $btn .= '<i class="fas fa-eye" aria-hidden="true"></i> </a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                if (Auth::user()->Divisi->nama == "Gudang Barang Masuk") {
                    $btn .= '<a class="dropdown-item" href="/bppb/permintaan_bahan_baku/' . $s->id . '"><span style="color: black;"><i class="fas fa-box-open" aria-hidden="true"></i>&nbsp;Permintaan Bahan Baku</span></a>';
                    $btn .= '<a class="dropdown-item" href="/bppb/pengembalian_barang_gudang/' . $s->id . '"><span style="color: black;"><i class="fas fa-dolly" aria-hidden="true"></i>&nbsp;Pengembalian Barang Gudang</span></a>';
                } else if (Auth::user()->Divisi->nama == "Gudang Barang Jadi") {
                    $btn .= '<a class="dropdown-item" href="/bppb/penyerahan_barang_jadi/' . $s->id . '"><span style="color: black;"><i class="fas fa-pallet" aria-hidden="true"></i>&nbsp;Penyerahan Barang Jadi</span></a>';
                } else if (Auth::user()->Divisi->nama == "Gudang Karantina" ||  Auth::user()->Divisi->nama == "Produksi") {
                    $btn .= '<a class="dropdown-item" href="/bppb/permintaan_bahan_baku/' . $s->id . '"><span style="color: black;"><i class="fas fa-box-open" aria-hidden="true"></i>&nbsp;Permintaan Bahan Baku</span></a>';
                    $btn .= '<a class="dropdown-item" href="/bppb/pengembalian_barang_gudang/' . $s->id . '"><span style="color: black;"><i class="fas fa-dolly" aria-hidden="true"></i>&nbsp;Pengembalian Barang Gudang</span></a>';
                    $btn .= '<a class="dropdown-item" href="/bppb/penyerahan_barang_jadi/' . $s->id . '"><span style="color: black;"><i class="fas fa-pallet" aria-hidden="true"></i>&nbsp;Penyerahan Barang Jadi</span></a>';
                }
                return $btn;
            })
            ->addColumn('status', function ($s) {
                $bppb_id = $s->id;
                $perakitan = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
                    $q->where('bppb_id', $bppb_id);
                })->count();

                $penyerahan_barang_jadi = DetailPenyerahanBarangJadi::whereHas('PenyerahanBarangJadi', function ($q) use ($bppb_id) {
                    $q->where('bppb_id', $bppb_id);
                })->count();

                $str = "";
                if ($perakitan <= $s->jumlah && $penyerahan_barang_jadi <= 0) {
                    $str = '<div><small class="warning-text">Sedang Proses</small></div>';
                } else if ($perakitan == 0 || $penyerahan_barang_jadi == 0) {
                    $str = '<div><small class="danger-text">Belum Proses</div>';
                } else if ($perakitan >= $s->jumlah && $penyerahan_barang_jadi >= $s->jumlah) {
                    $str = '<div><small class="success-text">Sudah Close</div>';
                } else {
                    $str = '<div><small class="warning-text">Sedang Proses</small></div>';
                }
                return $str;
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
            ->rawColumns(['gambar', 'produk', 'aksi', 'laporan', 'status'])
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
                'model' => 'required',
            ],
            [
                'detail_produk_id.required' => "Silahkan Pilih Produk",
                'divisi_id.reqired' => "Silahkan Pilih Divisi",
                'jumlah.required' => "Jumlah Harus Diisi",
                'tanggal_bppb.required' => "Tanggal Harus Diisi",
                'model.required' => 'Model harus dipilih'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            $no_bppb = $request->no_bppb_urutan . '/' . $request->no_bppb_kode . '/' . $request->no_bppb_bulan . '/' . $request->no_bppb_tahun;
            $c = Bppb::create([
                'no_bppb' => $no_bppb,
                'detail_produk_id' => $request->detail_produk_id,
                'divisi_id' => $request->divisi_id,
                'tanggal_bppb' => $request->tanggal_bppb,
                'jumlah' => $request->jumlah
            ]);

            if ($c) {

                $u = PermintaanBahanBaku::create([
                    'bppb_id' => $c->id,
                    'divisi_id' => '11',
                    'tanggal' => Carbon::now()->toDateString(),
                    'jumlah' => $request->jumlah,
                    'status' => 'dibuat'
                ]);

                if ($u) {
                    for ($i = 0; $i < count($request->part_id); $i++) {
                        $k = DetailPermintaanBahanBaku::create([
                            'bill_of_material_id' => $request->part_id[$i],
                            'permintaan_bahan_baku_id' => $u->id,
                            'jumlah_diminta' => $request->part_jumlah_diminta[$i],
                            'jumlah_diterima' => 0
                        ]);
                        if (!$k) {
                            $bool = false;
                        }
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan BPPB");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan BPPB");
                    }
                }
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

    public function bppb_permintaan_bahan_baku($id)
    {
        $s = Bppb::find($id);
        return view('page.ppic.bppb_permintaan_bahan_baku_show', ['id' => $id, 's' => $s]);
    }

    public function bppb_permintaan_bahan_baku_show($id)
    {
        $s = "";
        if (Auth::user()->Divisi->nama == "Produksi" || Auth::user()->Divisi->nama == "PPIC" || Auth::user()->Divisi->nama == "Quality Control") {
            $s = PermintaanBahanBaku::where('bppb_id', $id)->get();
        } else if (Auth::user()->Divisi->nama == "Gudang Bahan Material") {
            $s = PermintaanBahanBaku::where([
                ['bppb_id', '=', $id],
                ['divisi_id', '=', Auth::user()->divisi_id]
            ])->whereIn('status', ['req_permintaan', 'acc_permintaan', 'rej_permintaan'])->get();
        }

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('divisi_id', function ($s) {
                return $s->Divisi->nama;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                if (Auth::user()->divisi->nama == "Produksi" || Auth::user()->Divisi->nama == "Quality Control") {
                    if ($s->status == "dibuat") {
                        $btn = '<a href="/bppb/permintaan_bahan_baku/status/' . $s->id . '/req_permintaan">
                                <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                                <div><small>Permintaan</small></div></a>';
                    } else if ($s->status == "req_permintaan") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "acc_permintaan") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_permintaan") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                } else if (Auth::user()->divisi->nama == "PPIC") {
                    if ($s->status == "dibuat") {
                        $btn = '<div><small class="info-text">Sedang Dibuat</small></div>';
                    } else if ($s->status == "req_permintaan") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "acc_permintaan") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_permintaan") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                } else if (Auth::user()->Divisi->nama == "Gudang Bahan Material") {
                    if ($s->status == "req_permintaan") {
                        $btn = '<a href="/bppb/permintaan_bahan_baku/status/' . $s->id . '/terima"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-check"></i></button></a>
                                <a href="/bppb/permintaan_bahan_baku/status/' . $s->id . '/tolak"><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-times"></i></button></a>';
                    } else if ($s->status == "acc_permintaan") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_permintaan") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                }

                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $btn .= '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/bppb/permintaan_bahan_baku/detail/show/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                if (Auth::user()->divisi->nama == "Gudang Bahan Material" || Auth::user()->divisi->nama == "PPIC") {
                    $btn .= '<a href = "/bppb/permintaan_bahan_baku/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
                    $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/perakitan/laporan/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                }
                return $btn;
            })
            ->rawColumns(['no_seri', 'aksi', 'status'])
            ->make(true);
    }

    public function bppb_permintaan_bahan_baku_status($id, $status)
    {
        $s = PermintaanBahanBaku::find($id);
        $s->status = $status;
        $u = $s->save();

        if ($u) {
            return redirect()->back()->with('success', "Berhasil merubah status Permintaan");
        } else {
            return redirect()->back()->with('error', "Gagal merubah status Permintaan");
        }
    }

    public function bppb_permintaan_bahan_baku_detail($id)
    {
        return view('page.ppic.bppb_permintaan_bahan_baku_detail_show', ['id' => $id]);
    }

    public function bppb_permintaan_bahan_baku_detail_show($id)
    {
        $s = DetailPermintaanBahanBaku::where('permintaan_bahan_baku_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('part_eng', function ($s) {
                return $s->BillOfMaterial->PartEng->nama;
            })
            ->rawColumns(['part_eng'])
            ->make(true);
    }

    public function bppb_permintaan_bahan_baku_edit($id)
    {
        $s = PermintaanBahanBaku::find($id);
        return view('page.ppic.bppb_permintaan_bahan_baku_edit', ['id' => $id, 's' => $s]);
    }

    public function bppb_permintaan_bahan_baku_update($id, Request $request)
    {
        if (!empty($request->detail_permintaan_bahan_baku_id)) {
            $bool = true;
            for ($i = 0; $i < count($request->detail_permintaan_bahan_baku_id); $i++) {
                $s = DetailPermintaanBahanBaku::find($request->detail_permintaan_bahan_baku_id[$i]);
                $s->jumlah_diterima = $request->jumlah_diterima[$i];
                $u = $s->save();
                if (!$u) {
                    $bool = false;
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Data");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
            }
        }
    }

    public function bppb_pengembalian_barang_gudang($id)
    {
        $s = Bppb::find($id);
        return view('page.ppic.bppb_pengembalian_barang_gudang_show', ['id' => $id, 's' => $s]);
    }

    public function bppb_pengembalian_barang_gudang_show($id)
    {
        $s = "";
        if (Auth::user()->Divisi->nama == "Produksi" || Auth::user()->Divisi->nama == "PPIC" || Auth::user()->Divisi->nama == "Quality Control") {
            $s = PengembalianBarangGudang::where('bppb_id', $id)->get();
        } else if (Auth::user()->Divisi->nama == "Gudang Bahan Material") {
            $s = PengembalianBarangGudang::where([
                ['bppb_id', '=', $id],
                ['divisi_id', '=', Auth::user()->divisi_id]
            ])->whereIn('status', ['req_pengembalian', 'acc_pengembalian', 'rej_pengembalian'])->get();
        }

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('divisi_id', function ($s) {
                return $s->Divisi->nama;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                if (Auth::user()->divisi->nama == "Produksi" || Auth::user()->Divisi->nama == "Quality Control") {
                    if ($s->status == "dibuat") {
                        $btn = '<a href="/bppb/pengembalian_barang_gudang/status/' . $s->id . '/req_pengembalian">
                                <button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                                <div><small>Pengembalian</small></div></a>';
                    } else if ($s->status == "req_pengembalian") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "acc_pengembalian") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_pengembalian") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                } else if (Auth::user()->divisi->nama == "PPIC") {
                    if ($s->status == "dibuat") {
                        $btn = '<div><small class="info-text">Sedang Dibuat</small></div>';
                    } else if ($s->status == "req_pengembalian") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "acc_pengembalian") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_pengembalian") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                } else if (Auth::user()->Divisi->nama == "Gudang Bahan Material") {
                    if ($s->status == "req_pengembalian") {
                        $btn = '<a href="/bppb/pengembalian_barang_gudang/status/' . $s->id . '/terima"><button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-check"></i></button></a>
                                <a href="/bppb/pengembalian_barang_gudang/status/' . $s->id . '/tolak"><button type="button" class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-times"></i></button></a>';
                    } else if ($s->status == "acc_pengembalian") {
                        $btn = '<div><small class="success-text">Diterima</small></div>';
                    } else if ($s->status == "rej_pengembalian") {
                        $btn = '<div><small class="danger-text">Ditolak</small></div>';
                    }
                }

                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $btn .= '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/bppb/pengembalian_barang_gudang/detail/show/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                if (Auth::user()->divisi->nama == "Gudang Bahan Material" || Auth::user()->divisi->nama == "PPIC") {
                    $btn .= '<a href = "/bppb/pengembalian_barang_gudang/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
                    $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/bppb/pengembalian_barang_gudang/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                }
                return $btn;
            })
            ->rawColumns(['no_seri', 'aksi', 'status'])
            ->make(true);
        // return DataTables::of($s)
        //     ->addIndexColumn()
        //     ->addColumn('part_eng', function ($s) {
        //         return $s->BillOfMaterial->PartEng->nama;
        //     })
        //     ->rawColumns(['part_eng'])
        //     ->make(true);
    }

    public function bppb_pengembalian_barang_gudang_status($id, $status)
    {
        $s = PengembalianBarangGudang::find($id);
        $s->status = $status;
        $u = $s->save();

        if ($u) {
            return redirect()->back()->with('success', "Berhasil merubah status Pengembalian");
        } else {
            return redirect()->back()->with('error', "Gagal merubah status Pengembalian");
        }
    }

    public function bppb_penyerahan_barang_jadi($id)
    {
        $s = Bppb::find($id);
        return view('page.ppic.bppb_penyerahan_barang_jadi_show', ['id' => $id, 's' => $s]);
    }

    public function bppb_penyerahan_barang_jadi_show($id)
    {
        $s = "";
        if (Auth::user()->Divisi->nama == "Produksi" || Auth::user()->Divisi->nama == "PPIC" || Auth::user()->Divisi->nama == "Quality Control") {
            $s = PenyerahanBarangJadi::where('bppb_id', $id)->get();
        } else if (Auth::user()->Divisi->nama == "Gudang Barang Jadi" || Auth::user()->Divisi->nama == "Gudang Karantina") {
            $s = PenyerahanBarangJadi::where([
                ['bppb_id', '=', $id],
                ['divisi_id', '=', Auth::user()->divisi_id]
            ])->whereIn('status', ['req_penyerahan', 'penyerahan'])->get();
        }

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('no_seri', function ($s) {
                $arr = [];
                foreach ($s->DetailPenyerahanBarangJadi as $i) {
                    array_push($arr, $i->HasilPerakitan->no_seri);
                }
                return implode("<br>", $arr);
            })
            ->editColumn('divisi_id', function ($s) {
                return $s->Divisi->nama;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                if (Auth::user()->divisi->nama == "Produksi") {
                    if ($s->status == "dibuat") {
                        $btn = '<a href="/bppb/penyerahan_barang_jadi/status/' . $s->id . '/req_penyerahan">
                                <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                                <div><small>Penyerahan</small></div></a>';
                    } else if ($s->status == "req_penyerahan") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "penyerahan") {
                        $btn = '<div><small class="success-text">Selesai</small></div>';
                    }
                } else if (Auth::user()->divisi->nama == "PPIC") {
                    if ($s->status == "dibuat") {
                        $btn = '<div><small class="info-text">Sedang Dibuat</small></div>';
                    } else if ($s->status == "req_penyerahan") {
                        $btn = '<div><small class="warning-text">Menunggu</small></div>';
                    } else if ($s->status == "penyerahan") {
                        $btn = '<div><small class="success-text">Selesai</small></div>';
                    }
                } else if (Auth::user()->Divisi->nama == "Gudang Barang Jadi" || Auth::user()->Divisi->nama == "Gudang Karantina") {
                    if ($s->status == "req_penyerahan") {
                        $btn = '<a href="/bppb/penyerahan_barang_jadi/status/' . $s->id . '/penyerahan">
                                <button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-check"></i></button>
                                <div><small>Terima</small></div></a>';
                    } else if ($s->status == "penyerahan") {
                        $btn = '<div><small class="success-text">Selesai</small></div>';
                    }
                }

                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/bppb/penyerahan_barang_jadi/detail/show/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                $btn .= '<a href = "/bppb/penyerahan_barang_jadi/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/bppb/penyerahan_barang_jadi/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['no_seri', 'aksi', 'status'])
            ->make(true);
    }

    public function bppb_penyerahan_barang_jadi_detail($id)
    {
        return view('page.ppic.bppb_penyerahan_barang_jadi_detail_show', ['id' => $id]);
    }

    public function bppb_penyerahan_barang_jadi_detail_show($id)
    {
        $s = DetailPenyerahanBarangJadi::where('penyerahan_barang_jadi_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('hasil_perakitan_id', function ($s) {
                if ($s->HasilPerakitan->HasilPengemasan->first()->no_barcode != "") {
                    return str_replace("/", "", $s->HasilPerakitan->HasilPengemasan->first()->Pengemasan->alias_barcode) . $s->HasilPerakitan->HasilPengemasan->first()->no_barcode;
                } else {
                    return str_replace("/", "", $s->HasilPerakitan->HasilMonitoringProses->first()->MonitoringProses->alias_barcode) . $s->HasilPerakitan->HasilMonitoringProses->first()->no_barcode;
                }
            })
            ->rawColumns(['hasil_perakitan_id'])
            ->make(true);
    }

    public function bppb_penyerahan_barang_jadi_status($id, $status)
    {
        $s = PenyerahanBarangJadi::find($id);
        $s->status = $status;
        $u = $s->save();
        $dp = $s->Bppb->detail_produk_id;
        $pbj = DetailPenyerahanBarangJadi::where('penyerahan_barang_jadi_id', $s->id)->get();
        $pbjc = $pbj->count();
        $bool = true;
        $arr = array();
        foreach ($pbj as $i) {
            $hp = HasilPengemasan::where('hasil_perakitan_id', $i->hasil_perakitan_id)
                ->orderBy('updated_at', 'desc')
                ->first();

            array_push($arr, $i->hasil_perakitan_id);
            $hps = HasilPengemasan::find($hp->id);
            $hps->status = "penyerahan";
            $us = $hps->save();
            if (!$us) {
                $bool = false;
            }
        }

        if (Auth::user()->divisi->nama == "Gudang Barang Jadi") {
            $gp = GudangProduk::where([
                ['detail_produk_id', '=', $dp],
                ['divisi_id', '=', Auth::user()->divisi_id]
            ])->first();
            $gpid = "";
            if ($gp) {
                $m = MutasiGudangProduk::where('gudang_produk_id', $gp->id)->orderBy('id', 'desc')->first();

                $gpc = MutasiGudangProduk::create([
                    'gudang_produk_id' => $gp->id,
                    'divisi_id' => $s->Bppb->divisi_id,
                    'tanggal' => Carbon::now()->toDateString(),
                    'keterangan' => 'Barang Penyerahan ref Bppb ' . $s->Bppb->no_bppb,
                    'jumlah_masuk' => $pbjc,
                    'jumlah_keluar' => '0',
                    'jumlah_saldo' => $pbjc + $m->jumlah_saldo
                ]);
                $gpid = $gpc->id;
            } else if (!$gp) {
                $gpi = GudangProduk::create([
                    'detail_produk_id' => $dp,
                    'divisi_id' => Auth::user()->divisi_id
                ]);

                if ($gpi) {
                    $gpc = MutasiGudangProduk::create([
                        'gudang_produk_id' => $gpi->id,
                        'divisi_id' => $s->Bppb->divisi_id,
                        'tanggal' => Carbon::now()->toDateString(),
                        'keterangan' => 'Barang Penyerahan ref Bppb ' . $s->Bppb->no_bppb,
                        'jumlah_masuk' => $pbjc,
                        'jumlah_keluar' => '0',
                        'jumlah_saldo' => $pbjc
                    ]);
                    $gpid = $gpc->id;
                }
            }
            if ($gpc != "") {
                echo json_encode($arr);
                for ($z = 0; $z < count($arr); $z++) {
                    HistoriMutasiGudangProduk::create([
                        'mutasi_gudang_produk_id' => $gpid,
                        'hasil_perakitan_id' => $arr[$z],
                        'status' => 'T'
                    ]);
                }
            }
        }
        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil merubah status Penyerahan");
        } else {
            return redirect()->back()->with('error', "Gagal merubah status Penyerahan");
        }
    }
}
