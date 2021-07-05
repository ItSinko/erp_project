<?php

namespace App\Http\Controllers;

use App\BillOfMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Imports\HasilPerakitanImport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Karyawan;
use App\User;
use App\Bppb;
use App\Produk;
use App\DetailProduk;
use App\Divisi;
use App\HasilMonitoringProses;
use App\Perakitan;
use App\HasilPerakitan;
use App\HasilPerakitanKaryawan;
use App\HistoriHasilPerakitan;
use App\KelompokProduk;
use App\KategoriProduk;
use Carbon\Carbon;
use App\Pengemasan;
use App\HasilPengemasan;
use App\CekPengemasan;
use App\DetailCekPengemasan;
use App\DetailPenyerahanBarangJadi;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserLogController;
use App\MonitoringProses;
use App\PartEng;
use App\PerbaikanProduksi;
use App\PersiapanPackingProduk;
use App\DetailPersiapanPackingProduk;
use App\PermintaanBahanBaku;
use App\DetailPermintaanBahanBaku;
use App\PengembalianBarangGudang;
use App\DetailPengembalianBarangGudang;
use App\PenyerahanBarangJadi;
use App\AnalisaPsPerakitan;
use App\AnalisaPsPengujian;
use App\AnalisaPsPengemasan;

class ProduksiController extends Controller
{
    protected $NotifikasiController;
    protected $UserLogController;

    public function __construct(
        NotifikasiController $NotifikasiController,
        UserLogController $UserLogController
    ) {
        $this->NotifikasiController = $NotifikasiController;
        $this->UserLogController = $UserLogController;
    }

    //BPPB
    public function bppb_permintaan_bahan_baku_create($id)
    {
        $s = Bppb::find($id);
        return view('page.produksi.bppb_permintaan_bahan_baku_create', ['id' => $id, 's' => $s]);
    }

    public function bppb_pengembalian_barang_gudang_create($id)
    {
        $s = Bppb::find($id);
        $pbb = DetailPermintaanBahanBaku::join('permintaan_bahan_bakus', 'detail_permintaan_bahan_bakus.permintaan_bahan_baku_id', '=', 'permintaan_bahan_bakus.id')
            ->where([
                ['permintaan_bahan_bakus.bppb_id', '=', $id],
                ['permintaan_bahan_bakus.status', '=', 'acc_permintaan']
            ])
            ->groupby('detail_permintaan_bahan_bakus.bill_of_material_id')
            ->selectRaw("distinct(detail_permintaan_bahan_bakus.bill_of_material_id) as bill_of_material_id, sum(detail_permintaan_bahan_bakus.jumlah_diterima) as jumlah_diterima")
            ->get();
        return view('page.produksi.bppb_pengembalian_barang_gudang_create', ['id' => $id, 's' => $s, 'pbb' => $pbb]);
    }

    public function bppb_pengembalian_barang_gudang_store(Request $request, $id)
    {
        $div = Divisi::where('nama', '=', 'Gudang Bahan Material')->first();
        $c = PengembalianBarangGudang::create([
            'bppb_id' => $id,
            'divisi_id' => $div->id,
            'tanggal' => $request->tanggal,
            'status' => 'dibuat',
        ]);

        if ($c) {
            $bool = true;
            for ($i = 0; $i < count($request->bill_of_material_id); $i++) {
                $cs = DetailPengembalianBarangGudang::create([
                    'pengembalian_id' => $c->id,
                    'bill_of_material_id' => $request->bill_of_material_id[$i],
                    'jumlah_ok' => $request->jumlah_ok[$i],
                    'jumlah_nok' => $request->jumlah_nok[$i]
                ]);

                if (!$cs) {
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

    public function bppb_penyerahan_barang_jadi_create($id)
    {
        $s = Bppb::find($id);
        $hp = HasilPengemasan::whereHas('Pengemasan.Bppb', function ($q) use ($id) {
            $q->where('id', $id);
        })->whereHas('HasilPerakitan', function ($q) {
            $q->doesntHave('DetailPenyerahanBarangJadi');
        })->get();
        return view('page.produksi.bppb_penyerahan_barang_jadi_create', ['id' => $id, 's' => $s, 'hp' => $hp]);
    }

    public function bppb_penyerahan_barang_jadi_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal' => 'required',
                'hasil_perakitan_id' => 'required'
            ],
            [
                'tanggal.required' => "Tanggal harus diisi",
                'hasil_perakitan_id.required' => "Hasil Perakitan harus diisi"
            ]
        );


        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            for ($i = 0; $i < count($request->divisi_id); $i++) {
                $c = PenyerahanBarangJadi::create([
                    'bppb_id' => $id,
                    'divisi_id' => $request->divisi_id[$i],
                    'tanggal' => $request->tanggal,
                    'status' => 'dibuat',
                ]);

                if ($c) {
                    for ($j = 0; $j < count($request->hasil_perakitan_id[$i]); $j++) {
                        $cs = DetailPenyerahanBarangJadi::create([
                            'penyerahan_barang_jadi_id' => $c->id,
                            'hasil_perakitan_id' => $request->hasil_perakitan_id[$i][$j]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Data");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
            }
        }
    }


    //PERAKITAN
    public function perakitan()
    {
        return view('page.produksi.perakitan_show');
    }

    public function perakitan_show()
    {
        $p = array();
        if (Auth::user()->Divisi->nama == "Produksi") {
            // $p = Bppb::has('perakitan')->get();
            $p = Bppb::has('PermintaanBahanBaku')->get();
        } else if (Auth::user()->Divisi->nama == "Quality Control") {
            $p = Bppb::whereHas('perakitan', function ($query) {
                $query->whereNotIn('status', ['0']);
            })->get();
        }
        return DataTables::of($p)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="purple-text">Perakitan: ' . $s->countHasilPerakitan() . ' ' . $s->DetailProduk->satuan . '</small></div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/perakitan/laporan/' . $s->id . '" data-id="' . $s->id . '">';
                $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-info">';
                $btn .= '<span style="color:white;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Detail Laporan</span></button></a>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->jumlah > $s->countHasilPerakitan()) {
                    $btn = '<a href="/perakitan/laporan/create/' . $s->id . '">';
                    $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-primary">';
                    $btn .= '<span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span></button></a>';
                } else if ($s->jumlah <= $s->countHasilPerakitan()) {
                    $btn = '<button type="button" class="rounded-pill btn btn-sm btn-secondary" disabled>
                      <span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span>
                    </button>';
                }
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi'])
            ->make(true);
    }

    public function perakitan_create()
    {
        $b = [];
        $i = 0;

        // $be = Perakitan::all();
        $be = Bppb::whereDoesntHave('Perakitan')->whereHas('PermintaanBahanBaku', function ($q) {
            $q->where('status', 'acc_permintaan');
        })->get();

        foreach ($be as $bes) {
            $b[$i] = $bes->id;
            $i++;
        }

        $s = Bppb::where('divisi_id', '=', Auth::user()->divisi_id)->whereIn('id', $b)->get();
        $kry = Karyawan::all();
        return view('page.produksi.perakitan_create', ['s' => $s, 'kry' => $kry]);
    }

    public function perakitan_store(Request $request)
    {
        $v = "";
        if ((!empty($request->tanggal) || !empty($request->karyawan_id)) && !empty($request->file)) {
            $v = Validator::make(
                $request->all(),
                [
                    'file' => 'mimes:csv,xls,xlsx',
                    'bppb_id' => 'required',
                    'tanggal_laporan' => 'required',
                    'no_seri' => 'required|unique:hasil_perakitans',
                ],
                [
                    'files.mimes' => "Ekstensi file harus menggunakan csv, xls, xlsx",
                    'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                    'no_seri.required' => "No Seri harus diisi",
                    'no_seri.unique' => "No Seri sudah digunakan, silahkan ganti dengan yang lain",
                    'bppb_id.required' => "Bppb harus diisi",
                ]
            );
        } else if ((!empty($request->tanggal) || !empty($request->karyawan_id)) || !empty($request->file)) {
            if ((!empty($request->tanggal) || !empty($request->karyawan_id)) && empty($request->file)) {
                $v = Validator::make(
                    $request->all(),
                    [
                        'bppb_id' => 'required',
                        'tanggal_laporan' => 'required',
                        'no_seri' => 'required|unique:hasil_perakitans',
                    ],
                    [
                        'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                        'no_seri.required' => "No Seri harus diisi",
                        'no_seri.unique' => "No Seri sudah digunakan, silahkan ganti dengan yang lain",
                        'bppb_id.required' => "Bppb harus diisi",
                    ]
                );
            } else if ((empty($request->tanggal) && empty($request->karyawan_id))  && !empty($request->file)) {
                $v = Validator::make(
                    $request->all(),
                    [
                        'file' => 'mimes:csv,xls,xlsx',
                        'bppb_id' => 'required',
                        'tanggal_laporan' => 'required',
                    ],
                    [
                        'files.mimes' => "Ekstensi file harus menggunakan csv, xls, xlsx",
                        'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                        'bppb_id.required' => "Bppb harus diisi",
                    ]
                );
            }
        } else if ((empty($request->tanggal) && empty($request->karyawan_id)) && empty($request->file)) {
            $v = Validator::make(
                $request->all(),
                [
                    'bppb_id' => 'required',
                    'tanggal_laporan' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                    'bppb_id.required' => "Bppb harus diisi",
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bppb = Bppb::find($request->bppb_id);
            $c = Perakitan::create([
                'bppb_id' => $request->bppb_id,
                'tanggal' => $request->tanggal_laporan,
                'pic_id' => Auth::user()->id
            ]);

            if ($c) {
                $k = Perakitan::find($c->id);
                $k->Karyawan()->sync($request->karyawan_id, false);
                $k->save();
                $bool = true;
                if (!empty($request->file) || !empty($request->no_seri)) {
                    if (!empty($request->file) && empty($request->no_seri)) {
                        $e = Excel::import(new HasilPerakitanImport($c->id), $request->file('file'));
                        if ($e) {
                            $u = User::where('divisi_id', '14')->get();
                            foreach ($u as $i) {
                                $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                            }
                            $this->UserLogController->create(Auth::user()->id, $request->bppb_id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                            return redirect()->back()->with('success', "Berhasil menambahkan Data");
                        } else {
                            return redirect()->back()->with('error', "Gagal melakukan Import");
                        }
                    } else if (empty($request->file) && !empty($request->no_seri)) {
                        for ($i = 0; $i < count($request->no_seri); $i++) {
                            $s = HasilPerakitan::create([
                                'perakitan_id' => $c->id,
                                'tanggal' => $request->tanggals[$i],
                                'no_seri' => $request->no_seri[$i],
                                'status' => 'req_pemeriksaan_terbuka'
                            ]);
                            if (!$s) {
                                $bool = false;
                            }
                        }
                        if ($bool == true) {
                            $u = User::where('divisi_id', '14')->get();
                            foreach ($u as $i) {
                                $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                            }
                            $this->UserLogController->create(Auth::user()->id, $request->bppb_id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                            return redirect()->back()->with('success', "Berhasil menambahkan Data");
                        } else {
                            return redirect()->back()->with('error', "Gagal menambah no seri Data");
                        }
                    }
                } else if (!empty($request->file) && !empty($request->no_seri)) {
                    for ($i = 0; $i < count($request->no_seri); $i++) {
                        $s = HasilPerakitan::create([
                            'perakitan_id' => $c->id,
                            'tanggal' => $request->tanggals[$i],
                            'no_seri' => $request->no_seri[$i],
                            'status' => 'req_pemeriksaan_terbuka'
                        ]);

                        if (!$s) {
                            $bool = false;
                        }
                    }

                    $e = Excel::import(new HasilPerakitanImport($c->id), $request->file('file'));
                    if (!$e) {
                        $bool = false;
                    }

                    if ($bool = true) {
                        $u = User::where('divisi_id', '14')->get();
                        foreach ($u as $i) {
                            $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                        }
                        $this->UserLogController->create(Auth::user()->id, $request->bppb_id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                        return redirect()->back()->with('success', "Berhasil menambahkan Data");
                    } else {
                        return redirect()->back()->with('error', "Gagal menambahkan Data");
                    }
                } else {
                    $u = User::where('divisi_id', '14')->get();
                    foreach ($u as $i) {
                        $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                    }
                    $this->UserLogController->create(Auth::user()->id, $request->bppb_id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                    return redirect()->back()->with('success', "Berhasil menambahkan Data");
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
            }
        }
    }

    public function perakitan_laporan($id)
    {
        return view('page.produksi.perakitan_laporan_show', ['id' => $id]);
    }

    public function perakitan_laporan_show($id)
    {
        $s = Perakitan::whereHas('Bppb', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->orderBy('id', 'desc')->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('jumlah', function ($s) {
                $btn = HasilPerakitan::where('perakitan_id', $s->id)->count();
                return $btn . " " . $s->Bppb->DetailProduk->satuan;
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Karyawan as $i) {
                    array_push($arr, $i->nama);
                }
                return implode("<br>", $arr);
            })
            // ->addColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == '0') {
            //         $btn = '<div class="inline-flex">
            //             <a href = "/perakitan/laporan/status/' . $s->id . '/12">
            //                 <button type="button" class="btn btn-block btn-outline-info karyawan-img-small" style="border-radius:50%;" title="Kirim Laporan ke Quality Control"><i class="far fa-paper-plane"></i></button>
            //             </a>
            //         </div>';
            //     } else if ($s->status == '12') {
            //         $btn = '<span class="label info-text">Dibuat</span>';
            //     }
            //     return $btn;
            // })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/perakitan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                if ($s->HasilPerakitan->count() <= 0) {
                    $btn .= '<a href = "/perakitan/laporan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
                    $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/perakitan/laporan/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                }
                return $btn;
            })
            ->rawColumns(['status', 'aksi', 'operator'])
            ->make(true);
    }

    public function perakitan_laporan_create($id)
    {
        $b = Bppb::find($id);

        $kry2 = Karyawan::whereHas('Perakitan', function ($q) use ($id) {
            $q->where('perakitans.bppb_id', $id);
        })->select('id')->get();

        $kry = Karyawan::all();

        $div = Divisi::all();

        $p = Perakitan::where('bppb_id', $id)->get();

        return view('page.produksi.perakitan_laporan_create', ['b' => $b, 'id' => $id, 'kry' => $kry, 'kry2' => $kry2, 'p' => $p, 'div' => $div]);
    }

    public function perakitan_laporan_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'alias.*' => 'required',
                'karyawan_id.*' => 'required'
            ],
            [
                'karyawan_id.*.required' => "Karyawan harus diisi",
                'alias.*.required' => "Alias harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bppb = Bppb::find($id);
            if (!empty($request->alias)) {
                $bool = true;
                for ($i = 0; $i < count($request->alias); $i++) {
                    $c = Perakitan::create([
                        'bppb_id' => $id,
                        'alias_tim' => $request->alias[$i],
                        'tanggal' => Carbon::now()->toDateString(),
                        'pic_id' => Auth::user()->id,
                        'status' => '0'
                    ]);

                    if ($c) {
                        $p = Perakitan::find($c->id);
                        $p->Karyawan()->sync($request->karyawan_id[$i], false);
                        $u = $p->save();
                        if (!$u) {
                            $bool = false;
                        }
                    } else {
                        $bool = false;
                    }
                }
                if ($bool == true) {
                    return redirect()->back()->with('success', "Berhasil menambahkan Data");
                } else if ($bool == false) {
                    return redirect()->back()->with('error', "Gagal melakukan Import");
                }
            }
        }
    }

    public function perakitan_laporan_edit($id)
    {
        $sh = Perakitan::find($id);
        $kry = Karyawan::all();
        return view('page.produksi.perakitan_laporan_edit', ['id' => $id, 'sh' => $sh, 'kry' => $kry]);
    }

    public function perakitan_laporan_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal_laporan' => 'required',
                'no_seri' => 'required',
            ],
            [
                'tanggal_laporan.required' => 'Tanggal wajib diisi',
                'no_seri.required' => 'No Seri harus diisi',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $p = Perakitan::find($id);
            $p->tanggal = $request->tanggal_laporan;
            $p->Karyawan()->sync($request->karyawan_id, false);
            $p->save();
            $bool = true;

            if ($p) {
                $hpid = array();
                if (!empty($request->no_seri)) {
                    for ($i = 0; $i < count($request->no_seri); $i++) {
                        if (!empty($request->id[$i])) {

                            $hp = HasilPerakitan::find($request->id[$i]);
                            $hp->tanggal = $request->tanggals[$i];
                            $hp->no_seri = $request->no_seri[$i];
                            $hp->save();
                            $hpid[$i] = $request->id[$i];
                            if (!$hp) {
                                $bool = false;
                            }
                        } else if (empty($request->id[$i])) {
                            $c = HasilPerakitan::create([
                                'perakitan_id' => $id,
                                'tanggal' => $request->tanggals[$i],
                                'no_seri' => $request->no_seri[$i],
                            ]);

                            if ($c) {
                                $hpid[$i] = $c->id;
                            }
                        }
                    }
                    if (!empty($hpid)) {
                        HasilPerakitan::where('perakitan_id', $id)->whereNotIn('id', $hpid)->delete();
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil mengubah Data");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal mengubah Data");
                    }
                } else {
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil mengubah Data");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }
    }

    public function perakitan_laporan_delete($id, Request $request)
    {
        $p = Perakitan::find($id);
        $this->UserLogController->create(Auth::user()->id, "Perakitan untuk BPPB " . $p->Bppb->no_bppb, 'Perakitan', 'Hapus', $request->keterangan_log);
        $u = User::where('divisi_id', '14')->get();
        foreach ($u as $i) {
            $cs = $this->NotifikasiController->create("Perakitan", "telah menghapus Perakitan " . $p->no_bppb, Auth::user()->id, $i->id, "/perakitan");
        }
        $p->delete();

        return redirect('/perakitan')->with('success', "Berhasil menghapus data perakitan");
    }

    // public function perakitan_laporan_status($id, $status)
    // {
    //     $p = Perakitan::find($id);
    //     if ($status == '12') {
    //         $p->status = $status;
    //         $u = $p->save();
    //         if ($u) {
    //             $hp = HasilPerakitan::where('perakitan_id', $id)->get();
    //             $bool = true;
    //             foreach ($hp as $i) {
    //                 $h = HasilPerakitan::find($i->id);
    //                 $h->status = 'req_pemeriksaan_terbuka';
    //                 $up = $h->save();
    //                 if (!$up) {
    //                     $bool = false;
    //                 }
    //             }
    //             if ($bool == true) {
    //                 return redirect()->back();
    //             }
    //         }
    //     }
    // }

    public function perakitan_hasil($id)
    {
        $sh = Perakitan::find($id);
        return view('page.produksi.perakitan_hasil_show', ['id' => $id, 'sh' => $sh]);
    }

    public function perakitan_hasil_show($id)
    {
        $s = HasilPerakitan::where('perakitan_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('no_seri', function ($s) {
                return $s->Perakitan->alias_tim . $s->no_seri;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                $id = $s->id;
                $p = PerbaikanProduksi::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                $a = AnalisaPsPerakitan::whereHas('HasilPerakitan', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == 'dibuat') {
                    $btn = '<small class="info-text">Draft</small>';
                } else if ($s->status == 'req_pemeriksaan_terbuka') {
                    $btn = '<small class="warning-text">Pemeriksaan Terbuka</small>';
                } else if ($s->status == 'acc_pemeriksaan_terbuka') {
                    $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/req_pemeriksaan_tertutup"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                            <div><small> Permohonan Pemeriksaan Tertutup</small></div></a>
                            <div><small class="success-text">Pemeriksaan Terbuka OK</small></div>';
                } else if ($s->status == 'rej_pemeriksaan_terbuka') {
                    if ($s->tindak_lanjut_terbuka == "operator") {
                        $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/perbaikan_pemeriksaan_terbuka"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Lakukan Perbaikan</small></div></a>
                                <div><small class="danger-text">Pemeriksaan Terbuka Not OK</small></div>';
                    } else if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn = '<small class="danger-text">Analisa Produk Spesialis</small>';
                    }
                } else if ($s->status == "perbaikan_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/req_pemeriksaan_terbuka">
                            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                            <div><small> Permohonan Pemeriksaan Terbuka</small></div></a>';
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<small class="warning-text">Pemeriksaan Tertutup</small>';
                } else if ($s->status == 'acc_pemeriksaan_tertutup') {
                    $btn = '<small class="success-text">Pengujian</small>';
                } else if ($s->status == 'rej_pemeriksaan_tertutup') {
                    if ($s->tindak_lanjut_tertutup == "perbaikan") {
                        $btn = '<div><small class="text-muted">Perbaikan Produksi</small></div>
                                <div><small class="danger-text">Pemeriksaan Tertutup Not OK</small></div>';
                    } else if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn = '<small class="danger-text">Analisa Produk Spesialis</small>';
                    }
                } else if ($s->status == "perbaikan_pemeriksaan_tertutup") {

                    $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/req_pemeriksaan_tertutup">
                            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                            <div><small> Permohonan Pemeriksaan Tertutup</small></div></a>';
                    if ($p) {
                        $btn .= '<div><a href="#" class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                                 <small class="success-text"><i class="fas fa-search"></i> Hasil Perbaikan</small></a></div>';
                    }
                } else if ($s->status == "analisa_pemeriksaan_terbuka_ps") {
                    if ($a) {
                        if ($a->tindak_lanjut == "karantina") {
                            $btn .= '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Analisa</small></div></a>';
                        } else if ($a->tindak_lanjut == "operator") {
                            $btn .= '<a href="/perakitan/hasil/status/' . $s->id . '/perbaikan_pemeriksaan_terbuka"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Lakukan Perbaikan</small></div></a>
                            <div><a href="#" class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '">
                            <small class="success-text"><i class="fas fa-search"></i> Lihat Analisa</small></a></div>';
                        }
                    }
                } else if ($s->status == "analisa_pemeriksaan_tertutup_ps") {
                    if ($a) {
                        $btn .= '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/perakitan/analisa_ps/show/' . $a->id . '"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                        <div><small> Lihat Analisa</small></div></a>';
                    }
                    $btn .= '<div><small class="success-text">Pemeriksaan Tertutup PS</small></div>';
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/hasil/edit/' . $s->id . '">
                      <button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm m-1 deletenoserimodal" style="border-radius:50%;" data-toggle="modal" data-target="#deletenoserimodal" data-attr="{{route(\'perakitan.hasil.delete\', [\'id\' => ' . $s->id . '])}}"><i class="fas fa-trash"></i></button>
                  ';
                } else if ($s->status !== "req_pemeriksaan_terbuka") {
                    $btn = '<button type="button" class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-trash"></i></button>
                  ';
                }
                return $btn;
            })
            ->rawColumns(['operator', 'status', 'aksi'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_hasil_detail($id)
    {
        $s = HasilPerakitan::find($id);
        return view('perakitan.hasil.detail', ['id' => $id, 's' => $s]);
    }

    public function perakitan_hasil_import_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'file' => 'required|mimes:csv,xls,xlsx',
            ],
            [
                'file.required' => "Pilih file import terlebih dahulu",
                'file.mimes' => "Data harus .csv, .xls, .xlsx"
            ]
        );


        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $e = Excel::import(new HasilPerakitanImport($id), $request->file('file'));
            if ($e) {
                return redirect()->back()->with('success', "Berhasil menambahkan Data");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
            }
        }
    }

    public function perakitan_hasil_create($id)
    {
        $sh = Perakitan::find($id);
        $k = Karyawan::all();

        return view('page.produksi.perakitan_hasil_create', ['id' => $id, 'sh' => $sh, 'k' => $k]);
    }

    public function perakitan_hasil_store($id, Request $request)
    {
        $s = true;
        $v = Validator::make(
            $request->all(),
            [
                'tanggal' => 'required',
                'no_seri' => 'required'
            ],
            [
                'tanggal.required' => 'Tanggal harus diisi',
                'no_seri.required' => 'No Seri harus diisi'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            for ($i = 0; $i < count($request->no_seri); $i++) {
                $s = HasilPerakitan::create([
                    'perakitan_id' => $id,
                    'tanggal' => $request->tanggal,
                    'no_seri' => $request->no_seri[$i],
                    'status' => 'req_pemeriksaan_terbuka'
                ]);
                if (!$s) {
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

    public function perakitan_hasil_edit($id)
    {
        $s = HasilPerakitan::find($id);
        $kry = Karyawan::all();
        return view('page.produksi.perakitan_hasil_edit', ['id' => $id, 's' => $s, 'kry' => $kry]);
    }

    public function perakitan_hasil_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal' => 'required',
                'no_seri' => 'required',
            ],
            [
                'tanggal.required' => 'Tanggal harus diisi',
                'no_seri.required' => 'No Seri harus diisi',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            $hp = HasilPerakitan::find($id);
            $hp->tanggal = $request->tanggal;
            $hp->no_seri = $request->no_seri;
            $u = $hp->save();

            if (!$u) {
                $bool = false;
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil mengubah Data");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }
    }

    public function perakitan_hasil_status($id, $status)
    {
        $hp = HasilPerakitan::find($id);
        $hp->status = $status;
        $u = $hp->save();
        if ($u) {
            if ($status == "perbaikan_pemeriksaan_terbuka" || $status == "perbaikan_pemeriksaan_tertutup") {
                if ($status == "perbaikan_pemeriksaan_terbuka") {
                    $c = HistoriHasilPerakitan::create([
                        "hasil_perakitan_id" => $id,
                        "kegiatan" => $status,
                        "tanggal" => Carbon::now()->toDateString(),
                        "hasil" => "ok",
                        "keterangan" => "",
                        "tindak_lanjut" => "ok"
                    ]);
                    if ($c) {
                        return redirect()->back();
                    }
                } else if ($status == "perbaikan_pemeriksaan_tertutup") {
                    $cs = PerbaikanProduksi::create([
                        "bppb_id" => $hp->Perakitan->Bppb->id,
                        "tanggal_permintaan" => Carbon::now()->toDateString(),
                        "status" => "req_perbaikan",
                        "ketidaksesuaian_proses" => "perakitan"
                    ]);

                    if ($cs) {
                        $p = PerbaikanProduksi::find($cs->id);
                        $p->HasilPerakitan()->syncWithoutDetaching([$id]);
                        $p->save();
                    }

                    $c = HistoriHasilPerakitan::create([
                        "hasil_perakitan_id" => $id,
                        "kegiatan" => $status,
                        "tanggal" => Carbon::now()->toDateString(),
                        "hasil" => "ok",
                        "keterangan" => "",
                        "tindak_lanjut" => "ok"
                    ]);
                    if ($c) {
                        return redirect()->back();
                    }
                }
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function perakitan_hasil_delete($id, Request $request)
    {
        $p = HasilPerakitan::where('id', $id)->first();
        $this->UserLogController->create(Auth::user()->id, "Hasil Perakitan " . $p->no_seri . ", untuk BPPB " . $p->Perakitan->Bppb->no_bppb, 'Hasil Perakitan', 'Hapus', $request->keterangan_log);

        $hp = HasilPerakitan::find($id);
        $hp->delete();

        return redirect()->back();
    }


    //PENGUJIAN
    public function pengujian()
    {
        return view('page.produksi.pengujian_show');
    }

    public function pengujian_show()
    {
        $s = Bppb::has('MonitoringProses')->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $bppb_id = $s->id;
                $count = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
                    $q->where('bppb_id', $bppb_id);
                })->whereDoesntHave('HasilMonitoringProses', function ($q) {
                    $q->where('hasil', 'ok');
                })->whereIn('status', ['acc_pemeriksaan_tertutup'])->count();
                $btn = '<hgroup>
                    <h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6>
                    <div class="subheading"><small class="info-text">Pengujian: ' . $count . ' ' . $s->DetailProduk->satuan . '</small></div>
                    </hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href="/pengujian/bppb/prd/' . $s->id . '">
            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
            <div><small>Lihat Laporan</small></div></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'aksi'])
            ->make(true);
    }

    public function pengujian_bppb($bppb_id)
    {
        $s = Bppb::find($bppb_id);
        return view('page.produksi.pengujian_bppb_show', ['bppb_id' => $bppb_id, 's' => $s]);
    }

    public function pengujian_bppb_show($bppb_id)
    {
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('no_seri', function ($s) {
                $res = $s->HasilPerakitan->Perakitan->alias_tim . $s->HasilPerakitan->no_seri;
                if ($s->no_barcode) {
                    $res .= " / " . str_replace("/", "", $s->alias_barcode) . $s->no_barcode;
                }
                return $res;
            })
            ->editColumn('hasil', function ($s) {
                $res = "";
                if ($s->hasil == "ok") {
                    $res = '<i class="fas fa-plus-circle" style="color:green;"></i>';
                } else if ($s->hasil == "nok") {
                    $res = '<i class="fas fa-times-circle" style="color:red;"></i>';
                }
                return $res;
            })
            ->addColumn('operator_prd', function ($s) {
                $arr = [];
                foreach ($s->HasilPerakitan->Perakitan->Karyawan as $i) {
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->addColumn('operator_qc', function ($s) {
                $res = $s->MonitoringProses->Karyawan->nama;
                return $res;
            })
            ->addColumn('pemeriksaan', function ($s) {
                $res = "<small><ol>";
                foreach ($s->HasilIkPemeriksaanPengujian as $i) {
                    $res .= "<li>" . $i->standar_keberterimaan . "</li>";
                }
                $res .= "</ol></small>";
                return $res;
            })
            ->addColumn('status', function ($s) {
                $str = "";
                $id = $s->id;

                $p = PerbaikanProduksi::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                    $q->where([
                        ['id', '=', $id]
                    ]);
                })->orderBy('updated_at', 'desc')->first();

                $a = AnalisaPsPengujian::whereHas('HasilMonitoringProses', function ($q) use ($id) {
                    $q->where('id', $id);
                })->orderBy('updated_at', 'desc')->first();

                if ($s->status == "req_monitoring_proses") {
                    if ($p) {
                        $str .= '<div><a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '">
                        <button class="btn btn-sm btn-outline-info"><i class="fas fa-search"></i>&nbsp;Hasil Perbaikan</button></a></div>';
                    }
                } else if ($s->status == "rej_monitoring_proses") {
                    if ($s->tindak_lanjut == 'perbaikan') {
                        $str = '<div><small class="danger-text">Perbaikan Produksi</small></div>';
                    } else if ($s->tindak_lanjut == 'produk_spesialis') {
                        $str = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    }
                } else if ($s->status == "req_perbaikan") {
                    $str = '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/pengujian/monitoring_proses/hasil/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                } else if ($s->status == "perbaikan_monitoring_proses") {
                    if ($p) {
                        $str .= '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                            <div><small> Lihat Hasil Perbaikan</small></div></a>
                            <div><small class="info-text">Perbaikan Produksi</small></div>';
                    }
                } else if ($s->status == "analisa_monitoring_proses") {
                    if ($a) {
                        if ($a->tindak_lanjut == "perbaikan") {
                            $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                <div><small>Lihat Hasil Analisa</small></div></a>
                                <div><small class="warning-text">Sedang dalam Perbaikan</small></div>';
                        } else if ($a->tindak_lanjut == "karantina") {
                            $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengujian/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                                <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                                <div><small> Lihat Hasil Analisa</small></div></a>
                                <div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                        }
                    }
                } else if ($s->status == "pengemasan") {
                    $str = '<i class="fas fa-check-circle" style="color:green;"></i>';
                }
                return $str;
            })
            ->rawColumns(['hasil', 'perbaikan', 'pemeriksaan', 'operator_qc', 'operator_prd', 'status'])
            ->make(true);
    }

    public function pengujian_perbaikan()
    {
        return view('page.produksi.pengujian_perbaikan_show');
    }

    public function pengujian_perbaikan_show()
    {
        $s = Bppb::with('MonitoringProses')->whereHas('MonitoringProses.HasilMonitoringProses', function ($q) {
            $q->where('hasil', 'nok');
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $bppb_id = $s->id;
                $count = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
                    $q->where('bppb_id', $bppb_id);
                })->whereDoesntHave('HasilMonitoringProses', function ($q) {
                    $q->where('hasil', 'ok');
                })->whereIn('status', ['acc_pemeriksaan_tertutup'])->count();
                $btn = '<hgroup>
                        <h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6>
                        <div class="subheading"><small class="info-text">Pengujian: ' . $count . ' ' . $s->DetailProduk->satuan . '</small></div>
                        </hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href="/pengujian/perbaikan/bppb/' . $s->id . '">
                <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                <div><small>Lihat Laporan </small></div></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'aksi'])
            ->make(true);
    }

    public function pengujian_perbaikan_bppb($id)
    {
        $b = Bppb::find($id);
        return view('page.produksi.pengujian_perbaikan_bppb_show', ['id' => $id, 'b' => $b]);
    }

    public function pengujian_perbaikan_bppb_show($id)
    {
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->where(
            [
                ['hasil', '=', 'nok'],
                ['tindak_lanjut', '=', 'perbaikan']
            ]
        )->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('hasil_perakitan_id', function ($s) {
                $res = $s->HasilPerakitan->no_seri;
                return $res;
            })
            ->editColumn('hasil', function ($s) {
                $res = '<i class="fas fa-times-circle" style="color:red;"></i>';
                return $res;
            })
            ->addColumn('karyawan', function ($s) {
                $res = $s->MonitoringProses->Karyawan->nama;
                return $res;
            })
            ->addColumn('pemeriksaan', function ($s) {
                $res = "<small><ol>";
                foreach ($s->HasilIkPemeriksaanPengujian as $i) {
                    $res .= "<li>" . $i->standar_keberterimaan . "</li>";
                }
                $res .= "</ol></small>";
                return $res;
            })
            ->addColumn('perbaikan', function ($s) {
                $res = "";
                if ($s->tindak_lanjut == "perbaikan") {
                    if ($s->status == "req_perbaikan") {
                        $res .= '<a href="/perbaikan/produksi/create/' . $s->id . '/pengujian">
                            <button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Perbaikan</small></div></a>';
                    } else if ($s->status == "acc_perbaikan") {
                        $res .= '<small class="info-text">Pengujian</small>';
                    }
                }
                return $res;
            })
            ->rawColumns(['hasil', 'perbaikan', 'pemeriksaan'])
            ->make(true);
    }

    public function pengujian_perbaikan_status($id, $status)
    {
        $u = HasilMonitoringProses::find($id);
        if ($status == "perbaikan_pengujian") {
            $u->status = "acc_perbaikan";
            $u->save();

            $c = HistoriHasilPerakitan::create([
                "hasil_perakitan_id" => $u->hasil_perakitan_id,
                "kegiatan" => $status,
                "tanggal" => Carbon::now()->toDateString(),
                "hasil" => "ok",
                "keterangan" => "",
                "tindak_lanjut" => "ok"
            ]);
            if ($c) {
                return redirect()->back();
            }
        }
    }

    public function pengemasan()
    {
        return view('page.produksi.pengemasan_show');
    }

    public function pengemasan_show()
    {
        $s = Bppb::with('MonitoringProses')->whereHas('MonitoringProses.HasilMonitoringProses', function ($q) {
            $q->whereIn('status', ['pengemasan']);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="success-text">Pengemasan: <b>' . $s->countRencanaPengemasan() . ' ' . $s->DetailProduk->satuan . '</b></small></div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/pengemasan/laporan/show/' . $s->id . '" data-id="' . $s->id . '">
                            <button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                        </a>
                        <a href="/pengemasan/bppb/' . $s->id . '">
                            <button type="button" class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button>
                        </a>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->jumlah > $s->countHasilPengemasan()) {
                    $btn = '<a href="/pengemasan/laporan/create/' . $s->id . '">';
                    $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-primary">';
                    $btn .= '<span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span></button></a>';
                } else if ($s->jumlah <= $s->countHasilPengemasan()) {
                    $btn = '<button type="button" class="rounded-pill btn btn-sm btn-secondary" disabled>
                      <span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span>
                    </button>';
                }
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi'])
            ->make(true);
    }

    public function pengemasan_bppb($bppb_id)
    {
        $s = Bppb::find($bppb_id);
        return view('page.produksi.pengemasan_bppb_show', ['bppb_id' => $bppb_id, 's' => $s]);
    }

    public function pengemasan_bppb_show($bppb_id)
    {
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($s) {
                $str = "";
                $h = HasilPengemasan::where('hasil_perakitan_id', $s->HasilPerakitan->id)->orderBy('created_at', 'desc')->first();
                $str = '<input type="checkbox" class="hasil_perakitan_id" id="hasil_perakitan_id" name="hasil_perakitan_id[]" value="' . $s->id . '" ';
                if ($h) {
                    $str .= 'disabled';
                }
                $str .= '>';
                return $str;
            })
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->Perakitan->alias_tim . $s->HasilPerakitan->no_seri;
            })
            ->addColumn('no_barcode', function ($s) {
                $h = HasilPengemasan::where('hasil_perakitan_id', $s->HasilPerakitan->id)->orderBy('created_at', 'desc')->first();
                if ($s->no_barcode != "") {
                    $str = str_replace("/", "", $s->MonitoringProses->alias_barcode) . $s->no_barcode;
                } else {
                    $str = str_replace("/", "", $h->Pengemasan->alias_barcode) . $h->no_barcode;
                }
                return $str;
            })
            ->addColumn('kondisi_unit', function ($s) {
                $id = $s->HasilPerakitan->id;
                $h = HasilPengemasan::where('hasil_perakitan_id', $id)->orderBy('created_at', 'desc')->first();
                $str = "";

                if ($h) {
                    if ($h->kondisi_unit == "baik") {
                        $str = '<i class="fas fa-check-circle" style="color:green;"></i>';
                    } else if ($h->kondisi_unit == "tidak") {
                        $str = '<i class="fas fa-times-circle" style="color:red;"></i>';
                    }
                } else {
                    $str = '<small class="text-muted">Belum Ada</small>';
                }
                return $str;
            })
            ->addColumn('hasil', function ($s) {
                $id = $s->HasilPerakitan->id;
                $h = HasilPengemasan::where('hasil_perakitan_id', $id)->orderBy('created_at', 'desc')->first();
                $str = "";

                if ($h) {
                    if ($h->hasil == "ok") {
                        $str = '<i class="fas fa-check-circle" style="color:green;"></i>';
                    } else if ($h->hasil == "nok") {
                        $str = '<i class="fas fa-times-circle" style="color:red;"></i>';
                    }
                } else {
                    $str = '<small class="text-muted">Belum Ada</small>';
                }

                return $str;
            })
            ->addColumn('status', function ($s) {
                $id = $s->HasilPerakitan->id;
                $h = HasilPengemasan::where('hasil_perakitan_id', $id)->orderBy('created_at', 'desc')->first();
                $str = "";
                if ($h) {
                    $hid = $h->id;
                    $p = PerbaikanProduksi::whereHas('HasilPengemasan', function ($q) use ($hid) {
                        $q->where('id', $hid);
                    })->orderBy('updated_at', 'desc')->first();

                    $a = AnalisaPsPengemasan::whereHas('HasilPengemasan', function ($q) use ($hid) {
                        $q->where('id', $hid);
                    })->orderBy('updated_at', 'desc')->first();

                    // if ($h->status == "req_pengemasan") {
                    //     $str = '<div><small class="warning-text">Menunggu QC</small></div>';
                    // } else if ($h->status == "rej_pengemasan") {
                    //     if($h->tindak_lanjut == "perbaikan"){
                    //         $str = '<div><small class="danger-text">Perbaikan Produksi</small></div>';
                    //     } else if($h->tindak_lanjut == "analisa_pengemasan_ps"){
                    //         $str = '<div><small class="danger-text">Analisa Produk Spesialis</small></div>';
                    //     }
                    // } else if ($h->status == "perbaikan_pengemasan") {
                    //     $str = '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $p->id . '" data-id="' . $p->id . '"><button type="button" class="btn btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                    //             <div><small> Lihat Hasil Perbaikan</small></div></a>
                    //             <div><small class="info-text">Perbaikan Produksi</small></div>';
                    // } else if ($h->status == "analisa_pengemasan_ps") {
                    //     if ($a->tindak_lanjut == "perbaikan") {
                    //         $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengemasan/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                    //             <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                    //             <div><small>Lihat Hasil Analisa</small></div></a>
                    //             <div><small class="warning-text">Sedang dalam Perbaikan</small></div>';
                    //     } else if ($a->tindak_lanjut == "karantina") {
                    //         $str = '<a class="analisapsmodal" data-toggle="modal" data-target="#analisapsmodal" data-attr="/pengemasan/analisa_ps/show/' . $a->id . '" data-id="' . $a->id . '">
                    //             <button class="btn btn-sm btn-outline-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-search"></i></button>
                    //             <div><small> Lihat Hasil Analisa</small></div></a>
                    //             <div><small class="danger-text">Masuk Gudang Karantina</small></div>';
                    //     }
                    // }
                }
                return $str;
            })
            ->rawColumns(['checkbox', 'kondisi_unit', 'hasil', 'status'])
            ->make(true);
    }

    public function pengemasan_laporan()
    {
        return view('page.produksi.pengemasan_laporan_show');
    }

    public function pengemasan_laporan_show($id)
    {
        $s = Pengemasan::where('bppb_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('operator', function ($s) {
                return $s->Karyawan->nama;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $c = CekPengemasan::where('detail_produk_id', $s->Bppb->DetailProduk->id)->get();
                // if ($s->status == "dibuat") {
                    if (($s->Bppb->jumlah > $s->Bppb->countHasilPengemasan()) && (count($c) > 0)) {
                        $btn .= '<a href = "/pengemasan/hasil/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>
                    <a href = "/pengemasan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                    <a href = "/pengemasan/hasil/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                    } else if (($s->Bppb->jumlah <= $s->Bppb->countHasilPengemasan()) || (count($c) <= 0)) {
                        $btn .= '<button class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-plus"></i></button>
                    <a href = "/pengemasan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                   <button class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-pencil-alt"></i></button>';
                    }
                // } else if ($s->status == "penyerahan") {
                //     $btn = '<a href = "/pengemasan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                // }
                return $btn;
            })
            ->addColumn('status', function ($s) {
                $btn = "";
                // if ($s->status == "dibuat") {
                    if ($s->countHasilPengemasanStatus(['req_pengemasan', 'rej_pengemasan']) <= 0) {
                        $btn = '<a href="/pengemasan/laporan/status/' . $s->id . '/penyerahan">
                            <button class="btn btn-info btn-sm m-1" style="border-radius:50%;">
                            <i class="fas fa-paper-plane"></i></button></a><div><small>Penyerahan</small></div>';
                    } else if ($s->countHasilPengemasanStatus(['req_pengemasan', 'rej_pengemasan']) > 0) {
                        $btn = '<button class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled>
                        <i class="fas fa-paper-plane"></i></button><div><small>Penyerahan</small></div>';
                    }
                // } else if ($s->status == "penyerahan") {
                //     $btn = '<div class="info-text">Diserahkan</div>';
                // }
                return $btn;
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    public function pengemasan_laporan_create($id, $arr)
    {
        $b = Bppb::find($id);
        $larr = explode(",", $arr);

        $cp = CekPengemasan::where('detail_produk_id', $b->detail_produk_id)->with('DetailCekPengemasan')->get();
        $kry = Karyawan::whereNotIn('jabatan', ['direktur', 'manager', 'supervisor'])->get();
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->whereIn('id', $larr)->get();

        $hmp = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->whereNotNull('no_barcode')->count();

        $hp =  HasilPengemasan::whereHas('Pengemasan', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->whereNotNull('no_barcode')->count();

        $cbrc = $hmp + $hp;

        return view('page.produksi.pengemasan_laporan_create', ['id' => $id, 'b' => $b, 'cp' => $cp, 'kry' => $kry, 's' => $s, 'cbrc' => $cbrc]);
    }

    public function pengemasan_laporan_status($id, $status)
    {
        if ($status == "penyerahan") {
            $s = Pengemasan::find($id);
            $s->status = $status;
            $u = $s->save();

            if ($u) {
                $gbj = PenyerahanBarangJadi::where([
                    ['bppb_id', '=', $s->bppb_id],
                    ['tanggal', '=', Carbon::now()->toDateString()],
                    ['status', '=', 'req_penyerahan']
                ])->whereHas('Divisi', function ($q) {
                    $q->where('nama', 'Gudang Barang Jadi');
                })->first();

                $gk = PenyerahanBarangJadi::where([
                    ['bppb_id', '=', $s->bppb_id],
                    ['tanggal', '=', Carbon::now()->toDateString()],
                    ['status', '=', 'req_penyerahan']
                ])->whereHas('Divisi', function ($q) {
                    $q->where('nama', 'Gudang Karantina');
                })->first();

                $hp = HasilPengemasan::where('pengemasan_id', $id)->get();
                $bool = true;
                foreach ($hp as $i) {
                    if ($i->hasil == "ok") {
                        if (empty($gbj)) {
                            $c = PenyerahanBarangJadi::create([
                                'divisi_id' => 13,
                                'bppb_id' => $s->bppb_id,
                                'tanggal' => Carbon::now()->toDateString(),
                                'status' => 'req_penyerahan'
                            ]);
                            if ($c) {
                                $gbj = PenyerahanBarangJadi::find($c->id);
                            }
                        }
                        $cs = DetailPenyerahanBarangJadi::create([
                            'penyerahan_barang_jadi_id' => $gbj->id,
                            'hasil_perakitan_id' => $i->hasil_perakitan_id
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    } else if ($i->hasil == "nok") {
                        if (empty($gk)) {
                            $c = PenyerahanBarangJadi::create([
                                'divisi_id' => 12,
                                'bppb_id' => $s->bppb_id,
                                'tanggal' => Carbon::now()->toDateString(),
                                'status' => 'req_penyerahan'
                            ]);
                            if ($c) {
                                $gk = PenyerahanBarangJadi::find($c->id);
                            }
                        }
                        $cs = DetailPenyerahanBarangJadi::create([
                            'penyerahan_barang_jadi_id' => $gk->id,
                            'hasil_perakitan_id' => $i->hasil_perakitan_id
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }
                }

                if ($bool == true) {
                    return redirect()->back();
                }
            }
        }
    }

    public function pengemasan_laporan_store(Request $request, $id)
    {
        $v = [];
        if (in_array("no", $request->has_barcode)) {
            $v = Validator::make(
                $request->all(),
                [
                    'karyawan_id' => 'required',
                    'tanggal_laporan' => 'required',
                    'no_seri' => 'required',
                    'no_barcode' => 'required',
                    'inisial_produk' => 'required',
                    'tipe_produk' => 'required',
                    'waktu_produksi' => 'required',
                    'urutan_bb' => 'required'

                ],
                [
                    'karyawan_id.required' => 'Operator harus dipilih',
                    'tanggal_laporan.required' => 'Tanggal Laporan harus diisi',
                    'no_seri.required' => 'No Seri harus diisi',
                    'no_barcode.required' => 'No Barcode harus diisi',
                    'inisial_produk.required' => 'Barcode harus diisi',
                    'tipe_produk.required' => 'Barcode harus diisi',
                    'waktu_produksi.required' => 'Barcode harus diisi',
                    'urutan_bb.required' => 'Barcode harus diisi'
                ]
            );
        } else {
            $v = Validator::make(
                $request->all(),
                [
                    'karyawan_id' => 'required',
                    'tanggal_laporan' => 'required',
                    'no_seri' => 'required'

                ],
                [
                    'karyawan_id.required' => 'Operator harus dipilih',
                    'tanggal_laporan.required' => 'Tanggal Laporan harus diisi',
                    'no_seri.required' => 'No Seri harus diisi'
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $alias_barcode = "";
            if (in_array("no", $request->has_barcode)) {
                $alias_barcode = $request->inisial_produk . "/" . $request->tipe_produk . "/" . $request->waktu_produksi . "/" . $request->urutan_bb;
            } else {
                $alias_barcode = NULL;
            }
            $c = Pengemasan::create([
                'bppb_id' => $id,
                'pic_id' => Auth::user()->id,
                'karyawan_id' => $request->karyawan_id,
                'tanggal' => $request->tanggal_laporan,
                'alias_barcode' => $alias_barcode
            ]);

            if (!empty($request->no_seri)) {
                $bool = true;
                for ($i = 0; $i < count($request->no_seri); $i++) {
                    $no_barcode = "";
                    if ($request->has_barcode[$i] == "yes") {
                        $no_barcode = NULL;
                    } else if ($request->has_barcode[$i] == "no") {
                        $no_barcode = $request->no_barcode[$i];
                    }
                    $cs = HasilPengemasan::create([
                        'pengemasan_id' => $c->id,
                        'hasil_perakitan_id' => $request->no_seri[$i],
                        'no_barcode' => $no_barcode,
                        'hasil' => NULL,
                        'keterangan' => NULL,
                        'tindak_lanjut' => NULL,
                        'status' => 'req_pengemasan'
                    ]);

                    $arrdcp = [];
                    $j = 0;
                    for ($z = 0; $z < count($request->detail_cek_pengemasan[$i]); $z++) {
                        if ($request->detail_cek_pengemasan[$i][$z] !== "nok") {
                            $arrdcp[$j] = $request->detail_cek_pengemasan[$i][$z];
                            $j++;
                        }
                    }

                    if ($cs) {
                        $k = HasilPengemasan::find($cs->id);
                        $k->DetailCekPengemasan()->sync($arrdcp, false);
                        $u = $k->save();

                        if (!$u) {
                            $bool = false;
                        }
                    }
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Pengemasan");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Pengemasan");
            }
        }
    }

    public function pengemasan_hasil($id)
    {
        $s = Pengemasan::find($id);
        $hp = HasilPengemasan::where('pengemasan_id', $id)->get();
        $c = CekPengemasan::where('detail_produk_id', $s->Bppb->DetailProduk->id)->get();
        return view('page.produksi.pengemasan_hasil_show', ['id' => $id, 's' => $s, 'c' => $c, 'hp' => $hp]);
    }

    public function pengemasan_hasil_create($id)
    {
        $b = Pengemasan::find($id);
        $cp = CekPengemasan::where('detail_produk_id', $b->Bppb->detail_produk_id)->with('DetailCekPengemasan')->get();
        $bppb_id = $b->bppb_id;
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->whereIn('status', ['pengemasan'])->doesntHave('HasilPerakitan.HasilPengemasan')->get();

        $barcode = [];
        if($b->alias_barcode != "")
        {
            $barcode = explode('/', $b->alias_barcode);
        }
        return view('page.produksi.pengemasan_hasil_create', ['id' => $id, 'b' => $b, 'cp' => $cp, 's' => $s, 'barcode' => $barcode]);
    }

    public function pengemasan_hasil_store($id, Request $request)
    {
        $v = [];
        if (in_array("no", $request->has_barcode)){
            $v = Validator::make(
                $request->all(),
                [
                    'no_seri.*' => 'required',
                    'no_barcode.*' => 'required',
                    'inisial_produk' => 'required',
                    'tipe_produk' => 'required',
                    'waktu_produksi' => 'required',
                    'urutan_bb' => 'required'
                ],
                [
                    'no_seri.*.required' => 'No Seri harus diisi',
                    'no_barcode.*.required' => "No Barcode Harus diisi",
                    'inisial_produk.required' => 'Barcode harus diisi',
                    'tipe_produk.required' => 'Barcode harus diisi',
                    'waktu_produksi.required' => 'Barcode harus diisi',
                    'urutan_bb.required' => 'Barcode harus diisi' 
                ]
            );
        }
        else
        {
            $v = Validator::make(
                $request->all(),
                [
                    'no_seri.*' => 'required',
                ],
                [
                    'no_seri.*.required' => 'No Seri harus diisi',
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            if (!empty($request->no_seri)) {
                $alias_barcode = "";
                if (in_array("no", $request->has_barcode)) {
                    $alias_barcode = $request->inisial_produk . "/" . $request->tipe_produk . "/" . $request->waktu_produksi . "/" . $request->urutan_bb;
                    $p = Pengemasan::find($id);
                    $p->alias_barcode = $alias_barcode;
                    $p->save();
                } else {
                    $alias_barcode = NULL;
                }
                $bool = true;
                for ($i = 0; $i < count($request->no_seri); $i++) {
                    $cs = HasilPengemasan::create([
                        'pengemasan_id' => $id,
                        'hasil_perakitan_id' => $request->no_seri[$i],
                        'no_barcode' => $request->no_barcode[$i],
                        'hasil' => NULL,
                        'keterangan' => NULL,
                        'tindak_lanjut' => NULL,
                        'status' => 'req_pengemasan'
                    ]);

                    $arrdcp = [];
                    $j = 0;
                    for ($z = 0; $z < count($request->detail_cek_pengemasan[$i]); $z++) {
                        if ($request->detail_cek_pengemasan[$i][$z] !== "nok") {
                            $arrdcp[$j] = $request->detail_cek_pengemasan[$i][$z];
                            $j++;
                        }
                    }

                    if ($cs) {
                        $k = HasilPengemasan::find($cs->id);
                        $k->DetailCekPengemasan()->sync($arrdcp, false);
                        $u = $k->save();

                        if (!$u) {
                            $bool = false;
                        }
                    }
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Pengemasan");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Pengemasan");
            }
        }
    }

    public function pengemasan_form()
    {
        return view('page.produksi.pengemasan_form_show');
    }

    public function pengemasan_form_show()
    {
        $s = DetailProduk::has('CekPengemasan')->with('Produk')->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->foto . '"';
                }
                $gambar .= 'title="' . $s->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->nama . '</h6><div class="subheading text-muted">' . $s->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/pengemasan/form/detail/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/pengemasan/form/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengemasan/form/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'aksi'])
            ->make(true);
    }

    public function pengemasan_form_create()
    {
        $dp = DetailProduk::doesntHave('CekPengemasan')->get();
        return view('page.produksi.pengemasan_form_create', ['dp' => $dp]);
    }

    public function pengemasan_form_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'detail_produk_id' => 'required',
                'perlengkapan' => 'required',
                'nama_barang' => 'required'
            ],
            [
                'detail_produk_id.required' => "Produk harus dipilih",
                'perlengkapan.required' => "Perlengkapan harus diisi",
                'nama_barang.required' => "Nama Barang harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            for ($i = 0; $i < count($request->perlengkapan); $i++) {
                $c = CekPengemasan::create([
                    'detail_produk_id' => $request->detail_produk_id,
                    'perlengkapan' => $request->perlengkapan[$i]
                ]);

                if ($c) {
                    echo $c->id;
                    for ($j = 0; $j < count($request->nama_barang[$i]); $j++) {
                        $cs = DetailCekPengemasan::create([
                            'cek_pengemasan_id' => $c->id,
                            'nama_barang' => $request->nama_barang[$i][$j]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }
                } else if (!$c) {
                    $bool = false;
                }
            }

            if ($bool == true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Perlengkapan Pengemasan");
            } else if ($bool == false) {
                return redirect()->back()->with('error', "Gagal menambahkan Perlengkapan Pengemasan");
            }
        }
    }

    public function perbaikan_produksi()
    {
        return view('page.produksi.perbaikan_produksi_show');
    }

    public function perbaikan_produksi_show()
    {
        $s = PerbaikanProduksi::with('Bppb', 'Karyawan')->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('bppb_id', function ($s) {
                return $s->Bppb->no_bppb;
            })
            ->editColumn('karyawan_id', function ($s) {
                if (!empty($s->karyawan_id)) {
                    return $s->Karyawan->nama;
                } else {
                    return "Belum Ada";
                }
            })
            ->editColumn('ketidaksesuaian_proses', function ($s) {
                return ucfirst(str_replace("_", " ", $s->ketidaksesuaian_proses));
            })
            ->editColumn('sebab_ketidaksesuaian', function ($s) {
                if (!empty($s->sebab_ketidaksesuaian)) {
                    return ucfirst(str_replace("_", " ", $s->sebab_ketidaksesuaian));
                } else {
                    return "Belum Ada";
                }
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup>
                        <h6 class="heading">' . $s->Bppb->DetailProduk->nama . '</h6>
                        <div class="subheading text-muted">' . $s->Bppb->DetailProduk->Produk->KelompokProduk->nama . '</div>
                        </hgroup>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="perbaikanproduksimodal" data-toggle="modal" data-target="#perbaikanproduksimodal" data-attr="/perbaikan/produksi/detail/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/perbaikan/produksi/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/perbaikan/produksi/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['produk', 'aksi'])
            ->make(true);
    }

    public function perbaikan_produksi_create($id, $proses)
    {
        $k = Karyawan::whereNotIn('jabatan', ['direktur', 'manager'])->get();
        $hp = "";
        $s = "";
        $bppbid = "";
        $dp = "";
        $p = "";

        if ($proses == "perakitan") {
            $s = HasilPerakitan::find($id);
            $bppbid = $s->Perakitan->Bppb->id;
            $dp = $s->Perakitan->Bppb->detail_produk_id;

            $p = DetailPermintaanBahanBaku::join('permintaan_bahan_bakus', 'detail_permintaan_bahan_bakus.permintaan_bahan_baku_id', '=', 'permintaan_bahan_bakus.id')
                ->where([
                    ['permintaan_bahan_bakus.bppb_id', '=', $bppbid],
                    ['permintaan_bahan_bakus.status', '=', 'acc_permintaan']
                ])
                ->groupby('detail_permintaan_bahan_bakus.bill_of_material_id')
                ->selectRaw("distinct(detail_permintaan_bahan_bakus.bill_of_material_id) as bill_of_material_id, sum(detail_permintaan_bahan_bakus.jumlah_diterima) as jumlah_diterima")
                ->get();

            $hp = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->where('status', ['rej_pemeriksaan_tertutup'])
                ->orWhereIn('tindak_lanjut_tertutup', ['perbaikan', 'produksi_spesialis'])
                ->get();
        } else if ($proses == "pengujian") {
            $s = HasilMonitoringProses::find($id);
            $bppbid = $s->MonitoringProses->Bppb->id;
            $dp = $s->MonitoringProses->Bppb->detail_produk_id;
            $p = DetailPermintaanBahanBaku::join('permintaan_bahan_bakus', 'detail_permintaan_bahan_bakus.permintaan_bahan_baku_id', '=', 'permintaan_bahan_bakus.id')
                ->where([
                    ['permintaan_bahan_bakus.bppb_id', '=', $bppbid],
                    ['permintaan_bahan_bakus.status', '=', 'acc_permintaan']
                ])
                ->groupby('detail_permintaan_bahan_bakus.bill_of_material_id')
                ->selectRaw("distinct(detail_permintaan_bahan_bakus.bill_of_material_id) as bill_of_material_id, sum(detail_permintaan_bahan_bakus.jumlah_diterima) as jumlah_diterima")
                ->get();

            $hp = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->with('HasilPerakitan')
                ->where([
                    ['status', '=', 'rej_monitoring_proses'],
                    ['tindak_lanjut', '=', 'perbaikan']
                ])
                ->orWhere([
                    ['tindak_lanjut', '=', 'produk_spesialis'],
                    ['status', '=', 'analisa_monitoring_proses']
                ])->get();
        } else if ($proses == "pengemasan") {
            $s = HasilPengemasan::find($id);
            $bppbid = $s->Pengemasan->Bppb->id;
            $dp = $s->Pengemasan->Bppb->detail_produk_id;
            $p = DetailPermintaanBahanBaku::join('permintaan_bahan_bakus', 'detail_permintaan_bahan_bakus.permintaan_bahan_baku_id', '=', 'permintaan_bahan_bakus.id')
                ->where([
                    ['permintaan_bahan_bakus.bppb_id', '=', $bppbid],
                    ['permintaan_bahan_bakus.status', '=', 'acc_permintaan']
                ])
                ->groupby('detail_permintaan_bahan_bakus.bill_of_material_id')
                ->selectRaw("distinct(detail_permintaan_bahan_bakus.bill_of_material_id) as bill_of_material_id, sum(detail_permintaan_bahan_bakus.jumlah_diterima) as jumlah_diterima")
                ->get();

            $hp = HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppbid) {
                    $q->where('bppb_id', $bppbid);
                  })->with('HasilPerakitan')
                  ->where([
                    ['status', '=', 'rej_pengemasan'],
                    ['tindak_lanjut', '=', 'perbaikan']
                  ])
                  ->orWhere([
                    ['status', '=', 'analisa_ps_pengemasan'],
                    ['tindak_lanjut', '=', 'produk_spesialis']
                  ])
                  ->get();
        }
        return view('page.produksi.perbaikan_produksi_create', ['id' => $id, 's' => $s, 'bppbid' => $bppbid, 'k' => $k, 'p' => $p, 'hp' => $hp, 'proses' => $proses]);
    }

    public function perbaikan_produksi_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'karyawan_id' => 'required',
                'kondisi_produk' => 'required',
                'sebab_ketidaksesuaian' => 'required',
                'nomor' => 'required',
                'tanggal_pengerjaan' => 'required',
                'analisa' => 'required',
                'realisasi_pengerjaan' => 'required',
                'hasil_perakitan_id' => 'required',
            ],
            [
                'karyawan_id' => 'Pilih Karyawan Operator',
                'kondisi_produk' => 'Isi Kondisi Produk',
                'sebab_ketidaksesuaian' => 'Pilih Penyebab Ketidaksesuaian',
                'nomor' => 'Isi Nomor Perbaikan',
                'tanggal_pengerjaan' => 'Isi Tanggal Perbaikan',
                'analisa' => 'Isi Analisa Pengerjaan',
                'realisasi_pengerjaan' => 'Isi Realisasi Pengerjaan',
                'hasil_perakitan_id' => 'Pilih No Seri Perbaikan',
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            $c = PerbaikanProduksi::create([
                'bppb_id' => $id,
                'karyawan_id' => $request->karyawan_id,
                'tanggal_permintaan' => $request->tanggal_permintaan,
                'kondisi_produk' => $request->kondisi_produk,
                'sebab_ketidaksesuaian' => $request->sebab_ketidaksesuaian,
                'ketidaksesuaian_proses' => $request->ketidaksesuaian_proses,
                'nomor' => $request->nomor,
                'tanggal_pengerjaan' => $request->tanggal_pengerjaan,
                'analisa' => $request->analisa,
                'realisasi_pengerjaan' => $request->realisasi_pengerjaan,
                'status' => 'acc_perbaikan'
            ]);
            if ($c) {
                $p = PerbaikanProduksi::find($c->id);
                if ($request->ketidaksesuaian_proses == "perakitan") {
                    $p->HasilPerakitan()->sync($request->hasil_perakitan_id);
                } else if ($request->ketidaksesuaian_proses == "pengujian") {
                    $p->HasilMonitoringProses()->sync($request->hasil_perakitan_id);
                } else if ($request->ketidaksesuaian_proses == "pengemasan") {
                    $p->HasilPengemasan()->sync($request->hasil_perakitan_id);
                }
                $p->BillOfMaterial()->sync($request->part);
                $u = $p->save();

                if ($u) {
                    for ($i = 0; $i < count($request->hasil_perakitan_id); $i++) {
                        if ($request->ketidaksesuaian_proses == "perakitan") {
                            $h = HasilPerakitan::find($request->hasil_perakitan_id[$i]);
                            if ($h->status == "rej_pemeriksaan_tertutup") {
                                if ($h->tindak_lanjut_tertutup == "perbaikan") {
                                    $h->status = "perbaikan_pemeriksaan_tertutup";
                                    $h->save();

                                    $c = HistoriHasilPerakitan::create([
                                        "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                        "kegiatan" => 'perbaikan_pemeriksaan_tertutup',
                                        "tanggal" => Carbon::now()->toDateString(),
                                        "hasil" => "ok",
                                        "keterangan" => "",
                                        "tindak_lanjut" => "ok"
                                    ]);

                                    if (!$c) {
                                        $bool = false;
                                    }
                                }
                            }
                        } else if ($request->ketidaksesuaian_proses == "pengujian") {
                            $u = HasilMonitoringProses::find($request->hasil_perakitan_id[$i]);
                            $u->status = "perbaikan_monitoring_proses";
                            $u->save();

                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $u->hasil_perakitan_id,
                                "kegiatan" => "perbaikan_pengujian",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "ok"
                            ]);
                        } else if ($request->ketidaksesuaian_proses == "pengemasan") {
                            $u = HasilPengemasan::find($request->hasil_perakitan_id[$i]);
                            $u->status = "perbaikan_pengemasan";
                            $u->save();

                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $u->hasil_perakitan_id,
                                "kegiatan" => "perbaikan_pengemasan",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "pengujian"
                            ]);

                            $mp_id = "";
                            $mp = MonitoringProses::where([
                                ['bppb_id', '=', $id],
                                ['tanggal', '=', Carbon::now()->toDateString()]
                            ])->first();

                            if (empty($mp)) {
                                $mp_c = MonitoringProses::create([
                                    'bppb_id' => $id,
                                    'tanggal' => Carbon::now()->toDateString(),
                                    'user_id' => Auth::user()->id
                                ]);

                                $mp_id = $mp_c->id;
                            } else if (!empty($mp)) {
                                $mp_id = $mp->id;
                            }

                            $cs = HasilMonitoringProses::create([
                                'monitoring_proses_id' => $mp_id,
                                'hasil_perakitan_id' => $u->hasil_perakitan_id,
                                'keterangan' => 'pengujian pengemasan'
                            ]);
                        }
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menyimpan data Perbaikan");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menyimpan data Perbaikan");
                    }
                } else if (!$u) {
                    return redirect()->back()->with('error', "Gagal menyimpan data Perbaikan");
                }
            }
        }
    }

    public function perbaikan_produksi_edit($id)
    {
        $s = PerbaikanProduksi::find($id);
        $dp = $s->Bppb->detail_produk_id;
        $bppbid = $s->Bppb->id;
        $p = PartEng::whereHas(
            'BillOfMaterial',
            function ($q) use ($dp) {
                $q->where('detail_produk_id', $dp);
            }
        )->get();
        $k = Karyawan::whereNotIn('jabatan', ['direktur', 'manager'])->get();
        $hp = "";


        if ($s->ketidaksesuaian_proses == "perakitan") {
            $hp1 = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->whereIn('status', ['rej_pemeriksaan_terbuka', 'rej_pemeriksaan_tertutup'])
                ->orWhereIn('tindak_lanjut_terbuka', ['perbaikan'])
                ->orWhereIn('tindak_lanjut_tertutup', ['perbaikan'])
                ->get();

            $hp2 = HasilPerakitan::whereHas('PerbaikanProduksi', function ($q) use ($id) {
                $q->where('id', $id);
            })->get();

            $hp = $hp1->merge($hp2);
        } else if ($s->ketidaksesuaian_proses == "pengujian") {
            $hp1 = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->whereIn('status', ['req_perbaikan'])->get();

            $hp2 = HasilMonitoringProses::whereHas('HasilPerakitan.PerbaikanProduksi', function ($q) use ($id) {
                $q->where('id', $id);
            })->get();

            $hp = $hp1->merge($hp2);
        } else if ($s->ketidaksesuaian_proses == "pengemasan") {
            $hp1 = HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->whereIn('status', ['req_perbaikan'])->get();

            $hp2 = HasilPengemasan::whereHas('HasilPerakitan.PerbaikanProduksi', function ($q) use ($id) {
                $q->where('id', $id);
            })->get();

            $hp = $hp1->merge($hp2);
        }
        return view('page.produksi.perbaikan_produksi_edit', ['id' => $id, 's' => $s, 'p' => $p, 'k' => $k, 'hp' => $hp]);
    }

    public function perbaikan_produksi_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'karyawan_id' => 'required',
                'kondisi_produk' => 'required',
                'sebab_ketidaksesuaian' => 'required',
                'nomor' => 'required',
                'tanggal_pengerjaan' => 'required',
                'analisa' => 'required',
                'realisasi_pengerjaan' => 'required',
                'hasil_perakitan_id' => 'required',
            ],
            [
                'karyawan_id' => 'Pilih Karyawan Operator',
                'kondisi_produk' => 'Isi Kondisi Produk',
                'sebab_ketidaksesuaian' => 'Pilih Penyebab Ketidaksesuaian',
                'nomor' => 'Isi Nomor Perbaikan',
                'tanggal_pengerjaan' => 'Isi Tanggal Perbaikan',
                'analisa' => 'Isi Analisa Pengerjaan',
                'realisasi_pengerjaan' => 'Isi Realisasi Pengerjaan',
                'hasil_perakitan_id' => 'Pilih No Seri Perbaikan',
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $p = PerbaikanProduksi::find($id);
            $p->karyawan_id = $request->karyawan_id;
            $p->kondisi_produk = $request->kondisi_produk;
            $p->sebab_ketidaksesuaian = $request->sebab_ketidaksesuaian;
            $p->nomor = $request->nomor;
            $p->tanggal_pengerjaan = $request->tanggal_pengerjaan;
            $p->analisa = $request->analisa;
            $p->realisasi_pengerjaan = $request->realisasi_pengerjaan;
            $p->status = 'acc_perbaikan';
            if ($request->ketidaksesuaian_proses == "perakitan") {
                $p->HasilPerakitan()->sync($request->hasil_perakitan_id);
            } else if ($request->ketidaksesuaian_proses == "pengujian") {
                $p->HasilMonitoringProses()->sync($request->hasil_perakitan_id);
            } else if ($request->ketidaksesuaian_proses == "pengemasan") {
                $p->HasilPengemasan()->sync($request->hasil_perakitan_id);
            }

            $p->PartEng()->sync($request->part);
            $u = $p->save();

            if ($u) {
                for ($i = 0; $i < count($request->hasil_perakitan_id); $i++) {
                    if ($request->ketidaksesuaian_proses == "perakitan") {
                        $h = HasilPerakitan::find($request->hasil_perakitan_id[$i]);

                        if ($h->status == "rej_pemeriksaan_terbuka") {
                            if ($h->tindak_lanjut_terbuka == "operator") {
                                $h->status = "perbaikan_pemeriksaan_terbuka";
                                $h->save();

                                $c = HistoriHasilPerakitan::create([
                                    "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                    "kegiatan" => 'perbaikan_pemeriksaan_terbuka',
                                    "tanggal" => Carbon::now()->toDateString(),
                                    "hasil" => "ok",
                                    "keterangan" => "",
                                    "tindak_lanjut" => "ok"
                                ]);
                            } else if ($h->tindak_lanjut_terbuka == "produk_spesialis") {
                                $h->status = "analisa_pemeriksaan_terbuka_ps";
                                $h->save();

                                $c = HistoriHasilPerakitan::create([
                                    "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                    "kegiatan" => 'analisa_pemeriksaan_terbuka_ps',
                                    "tanggal" => Carbon::now()->toDateString(),
                                    "hasil" => "ok",
                                    "keterangan" => "",
                                    "tindak_lanjut" => "operator"
                                ]);
                            }
                        } else if ($h->status == "rej_pemeriksaan_tertutup") {
                            if ($h->tindak_lanjut_tertutup == "operator") {
                                $h->status = "perbaikan_pemeriksaan_tertutup";
                                $h->save();

                                $c = HistoriHasilPerakitan::create([
                                    "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                    "kegiatan" => 'perbaikan_pemeriksaan_tertutup',
                                    "tanggal" => Carbon::now()->toDateString(),
                                    "hasil" => "ok",
                                    "keterangan" => "",
                                    "tindak_lanjut" => "ok"
                                ]);
                            } else if ($h->tindak_lanjut_tertutup == "produk_spesialis") {
                                $h->status = "analisa_pemeriksaan_tertutup_ps";
                                $h->save();

                                $c = HistoriHasilPerakitan::create([
                                    "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                    "kegiatan" => 'analisa_pemeriksaan_tertutup_ps',
                                    "tanggal" => Carbon::now()->toDateString(),
                                    "hasil" => "ok",
                                    "keterangan" => "",
                                    "tindak_lanjut" => "perbaikan"
                                ]);
                            }
                        }
                    } else if ($request->ketidaksesuaian_proses == "pengujian") {
                        $u = HasilMonitoringProses::find($request->hasil_perakitan_id[$i]);
                        if ($u->status == "req_perbaikan") {
                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $u->hasil_perakitan_id,
                                "kegiatan" => "perbaikan_pengujian",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "ok"
                            ]);
                            $u->status = "acc_perbaikan";
                            $u->save();
                        }
                    } else if ($request->ketidaksesuaian_proses == "pengemasan") {
                        $u = HasilPengemasan::find($request->hasil_perakitan_id[$i]);
                        if ($u->status == "rej_pengemasan") {
                            if ($u->tindak_lanjut == 'perbaikan') {
                                $c = HistoriHasilPerakitan::create([
                                    "hasil_perakitan_id" => $u->hasil_perakitan_id,
                                    "kegiatan" => "perbaikan_pengemasan",
                                    "tanggal" => Carbon::now()->toDateString(),
                                    "hasil" => "ok",
                                    "keterangan" => "",
                                    "tindak_lanjut" => "pengujian"
                                ]);
                                $u->status = "req_pengujian";
                                $u->save();

                                $mp_id = "";
                                $mp = MonitoringProses::where([['bppb_id', '=', $id], ['tanggal', '=', Carbon::now()->toDateString()]])->first();
                                if (count($mp) <= 0) {
                                    $mp_c = MonitoringProses::create([
                                        'bppb_id' => $id,
                                        'tanggal' => Carbon::now()->toDateString(),
                                        'user_id' => Auth::user()->id
                                    ]);

                                    $mp_id = $mp_c->id;
                                } else if (count($mp) > 0) {
                                    $mp_id = $mp->id;
                                }

                                $cs = HasilMonitoringProses::create([
                                    'monitoring_proses_id' => $mp_id,
                                    'hasil_perakitan_id' => $u->hasil_perakitan_id,
                                    'keterangan' => 'pengujian pengemasan'
                                ]);
                            } 
                        }
                    }
                }
                return redirect()->back()->with('success', "Berhasil menyimpan data Perbaikan");
            } else if (!$u) {
                return redirect()->back()->with('error', "Gagal menyimpan data Perbaikan");
            }
        }
    }

    public function perbaikan_produksi_detail($id)
    {
        $s = PerbaikanProduksi::with('HasilMonitoringProses')
            ->where('id', $id)
            ->first();
        return view('page.produksi.perbaikan_produksi_detail_show', ['id' => $id, 's' => $s]);
    }

    public function persiapan_packing_produk()
    {
        return view('page.produksi.persiapan_packing_produk_show');
    }

    public function persiapan_packing_produk_show()
    {
        $s = Bppb::all();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('gambar', function ($s) {
                $gambar = '<img class="product-img-small img-fluid"';
                if (empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{url(\'assets/image/produk\')}}/noimage.png"';
                } else if (!empty($s->DetailProduk->foto)) {
                    $gambar .= 'src="{{asset(\'image/produk/\')}}/' . $s->DetailProduk->foto . '"';
                }
                $gambar .= 'title="' . $s->DetailProduk->nama . '">';
                return $gambar;
            })
            ->addColumn('produk', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->DetailProduk->nama . '</h6><div class="subheading text-muted">' . $s->DetailProduk->Produk->KelompokProduk->nama . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('jumlah', function ($s) {
                $btn = $s->jumlah . " " . $s->DetailProduk->satuan;
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                $p = PersiapanPackingProduk::where('bppb_id', $s->id)->first();
                if (empty($p)) {
                    $btn = '<a href = "/persiapan_packing_produk/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>';
                } else if (!empty($p)) {
                    $btn = '<a class="persiapanpackingprodukmodal" data-toggle="modal" data-target="#persiapanpackingprodukmodal" data-attr="/persiapan_packing_produk/detail/show/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>';
                    if ($p->status == 'req_persiapan') {
                        $btn .= '<a href = "/persiapan_packing_produk/edit/' . $p->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                        $btn .= '<a href = "/persiapan_packing_produk/delete/' . $p->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'aksi'])
            ->make(true);
    }

    public function persiapan_packing_produk_create($id)
    {
        $s = Bppb::find($id);
        return view('page.produksi.persiapan_packing_produk_create', ['id' => $id, 's' => $s]);
    }

    public function persiapan_packing_produk_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'ketersediaan.*' => 'required',
            ],
            [
                'ketersediaan.*.required' => "Ketersediaan harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = PersiapanPackingProduk::create([
                'user_id' => Auth::user()->id,
                'bppb_id' => $id,
                'status' => 'req_persiapan',
            ]);

            if ($c) {
                $bool = true;
                if (!empty($request->dokumen)) {
                    for ($i = 0; $i < count($request->dokumen); $i++) {
                        $cs = DetailPersiapanPackingProduk::create([
                            'persiapan_id' => $c->id,
                            'dokumen' => $request->dokumen[$i],
                            'ketersediaan' => $request->ketersediaan[$i],
                            'keterangan' => $request->keterangan[$i]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menyimpan Persiapan Packing");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menyimpan Persiapan Packing");
                    }
                }
            }
        }
    }

    public function persiapan_packing_produk_detail($id)
    {
        $s = Bppb::find($id);
        return view('page.produksi.persiapan_packing_produk_detail_show', ['id' => $id, 's' => $s]);
    }

    public function persiapan_packing_produk_detail_show($id)
    {
        $s = DetailPersiapanPackingProduk::whereHas('PersiapanPackingProduk', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('dokumen', function ($s) {
                return str_replace('_', ' ', ucwords($s->dokumen));
            })
            ->make(true);

        return view('page.produksi.persiapan_packing_produk_detail_show', ['id' => $id, 's' => $s]);
    }
}
