<?php

namespace App\Http\Controllers;

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

use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserLogController;
use App\MonitoringProses;
use App\PartEng;
use App\PerbaikanProduksi;

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


    //PERAKITAN
    public function perakitan()
    {
        return view('page.produksi.perakitan_show');
    }

    public function perakitan_show()
    {
        $p = array();
        if (Auth::user()->Divisi->nama == "Produksi") {
            $p = Bppb::has('perakitan')->get();
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

        $be = Perakitan::all();

        foreach ($be as $bes) {
            $b[$i] = $bes->bppb_id;
            $i++;
        }

        $s = Bppb::where('divisi_id', '=', Auth::user()->divisi_id)->whereNotIn('id', $b)->get();
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
        })->get();

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
                $btn .= '<a href = "/perakitan/laporan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/perakitan/laporan/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['status', 'aksi', 'operator'])
            ->make(true);
    }

    public function perakitan_laporan_create($id)
    {
        $b = Bppb::find($id);
        $kry = Karyawan::all();
        return view('page.produksi.perakitan_laporan_create', ['b' => $b, 'id' => $id, 'kry' => $kry]);
    }

    public function perakitan_laporan_store($id, Request $request)
    {
        $v = [];
        if (!empty($request->no_seri) && !empty($request->file)) {
            $v = Validator::make(
                $request->all(),
                [
                    'file' => 'mimes:csv,xls,xlsx',
                    'tanggal_laporan' => 'required',
                    'no_seri' => 'required|unique:hasil_perakitans',
                ],
                [
                    'files.mimes' => "Ekstensi file harus menggunakan csv, xls, xlsx",
                    'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                    'no_seri.required' => "No Seri harus diisi",
                    'no_seri.unique' => "No Seri sudah digunakan, silahkan ganti dengan yang lain",
                ]
            );
        } else if (!empty($request->no_seri) || !empty($request->file)) {
            if (!empty($request->no_seri) && empty($request->file)) {
                $v = Validator::make(
                    $request->all(),
                    [
                        'tanggal_laporan' => 'required',
                        'no_seri' => 'required|unique:hasil_perakitans',
                    ],
                    [
                        'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                        'no_seri.required' => "No Seri harus diisi",
                        'no_seri.unique' => "No Seri sudah digunakan, silahkan ganti dengan yang lain",
                    ]
                );
            } else if (empty($request->no_seri) && !empty($request->file)) {
                $v = Validator::make(
                    $request->all(),
                    [
                        'file' => 'mimes:csv,xls,xlsx',
                        'tanggal_laporan' => 'required',
                    ],
                    [
                        'files.mimes' => "Ekstensi file harus menggunakan csv, xls, xlsx",
                        'tanggal_laporan.required' => "Tanggal laporan harus diisi",
                    ]
                );
            }
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bppb = Bppb::find($id);
            $c = Perakitan::create([
                'bppb_id' => $id,
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
                            $this->UserLogController->create(Auth::user()->id, $id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
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
                            $this->UserLogController->create(Auth::user()->id, $id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
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

                    if ($bool == true) {
                        $u = User::where('divisi_id', '14')->get();
                        foreach ($u as $i) {
                            $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                        }
                        $this->UserLogController->create(Auth::user()->id, $id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                        return redirect()->back()->with('success', "Berhasil menambahkan Data");
                    } else {
                        return redirect()->back()->with('error', "Gagal menambahkan Data");
                    }
                } else {
                    $u = User::where('divisi_id', '14')->get();
                    foreach ($u as $i) {
                        $cs = $this->NotifikasiController->create("Perakitan", "telah menambahkan Laporan Perakitan", Auth::user()->id, $i->id, "/perakitan");
                    }
                    $this->UserLogController->create(Auth::user()->id, $id, 'Perakitan BPPB ' . $bppb->no_bppb . ' tanggal ' . $request->tanggal_laporan, 'Tambah', "");
                    return redirect()->back()->with('success', "Berhasil menambahkan Data");
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
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
            ->editColumn('status', function ($s) {
                $btn = "";
                if ($s->status == 'dibuat') {
                    $btn = '<small class="info-text">Draft</small>';
                } else if ($s->status == 'req_pemeriksaan_terbuka') {
                    $btn = '<small class="warning-text">Pemeriksaan Terbuka</small>';
                } else if ($s->status == 'acc_pemeriksaan_terbuka') {
                    $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                            <div><small> Permohonan Pemeriksaan Tertutup</small></div></a>
                            <div><small class="success-text">Pemeriksaan Terbuka Diterima</small></div>';
                } else if ($s->status == 'rej_pemeriksaan_terbuka') {
                    if ($s->tindak_lanjut_terbuka == "operator") {
                        $btn = '<a href="/perbaikan/produksi/create/' . $s->id . '/perakitan"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Lakukan Perbaikan</small></div></a>
                                <div><small class="danger-text">Pemeriksaan Terbuka Ditolak</small></div>';
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
                        $btn = '<small class="danger-text">Masuk Perbaikan</small>';
                    } else if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn = '<small class="danger-text">Analisa Produk Spesialis</small>';
                    }
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
                'no_seri' => 'required',
            ],
            [
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
                    'tanggal' => $request->tanggals[$i],
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
            // if ($status == "perbaikan_pemeriksaan_terbuka" || $status == "perbaikan_pemeriksaan_tertutup") {
            //     $cs = PerbaikanProduksi::create([
            //         "bppb_id" => $hp->Perakitan->Bppb->id,
            //         "tanggal_permintaan" => Carbon::now()->toDateString(),
            //         "status" => "req_perbaikan",
            //         "ketidaksesuaian_proses" => "perakitan"
            //     ]);

            //     if ($cs) {
            //         $p = PerbaikanProduksi::find($cs->id);
            //         $p->HasilPerakitan()->syncWithoutDetaching([$id]);
            //         $p->save();
            //     }

            //     if ($status == "perbaikan_pemeriksaan_terbuka") {
            //         $c = HistoriHasilPerakitan::create([
            //             "hasil_perakitan_id" => $id,
            //             "kegiatan" => $status,
            //             "tanggal" => Carbon::now()->toDateString(),
            //             "hasil" => "ok",
            //             "keterangan" => "",
            //             "tindak_lanjut" => "ok"
            //         ]);
            //         if ($c) {
            //             return redirect()->back();
            //         }
            //     }
            // } else {
            return redirect()->back();
            // }
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
                <div><small>Lihat Laporan</small></div></a>';
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
        })->where([['hasil', '=', 'nok'], ['tindak_lanjut', '=', 'perbaikan']])->get();

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
                        $res .= '<a href="/perbaikan/produksi/create/' . $s->HasilPerakitan->id . '/pengujian">
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
                            <div><small>Lihat Laporan</small></div></a>';
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
                if (($s->Bppb->jumlah > $s->Bppb->countHasilPengemasan()) && count($c) > 0) {
                    $btn .= '<a href = "/pengemasan/hasil/create/' . $s->id . '"><button class="btn btn-success btn-sm m-1" style="border-radius:50%;"><i class="fas fa-plus"></i></button></a>
                    <a href = "/pengemasan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                    <a href = "/pengemasan/hasil/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                } else if (($s->Bppb->jumlah <= $s->Bppb->countHasilPengemasan()) || count($c) <= 0) {
                    $btn .= '<button class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-plus"></i></button>
                    <a href = "/pengemasan/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                   <button class="btn btn-secondary btn-sm m-1" style="border-radius:50%;" disabled><i class="fas fa-pencil-alt"></i></button>';
                }
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pengemasan_laporan_create($id)
    {
        $b = Bppb::find($id);
        $cp = CekPengemasan::where('detail_produk_id', $b->detail_produk_id)->with('DetailCekPengemasan')->get();
        $kry = Karyawan::whereNotIn('jabatan', ['direktur', 'manager', 'supervisor'])->get();
        $s = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($id) {
            $q->where('bppb_id', $id);
        })->whereIn('status', ['pengemasan'])->doesntHave('HasilPerakitan.HasilPengemasan')->get();
        return view('page.produksi.pengemasan_laporan_create', ['id' => $id, 'b' => $b, 'cp' => $cp, 'kry' => $kry, 's' => $s]);
    }

    public function pengemasan_laporan_store(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'karyawan_id' => 'required',
                'tanggal_laporan' => 'required',
                'no_seri' => 'required',
                'hasil' => 'required',
                'tindak_lanjut' => 'required'

            ],
            [
                'karyawan_id.required' => 'Operator harus dipilih',
                'tanggal_laporan.reqired' => 'Tanggal Laporan harus diisi',
                'no_seri.required' => 'No Seri harus diisi',
                'hasil' => 'required',
                'tindak_lanjut' => 'required'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = Pengemasan::create([
                'bppb_id' => $id,
                'pic_id' => Auth::user()->id,
                'karyawan_id' => $request->karyawan_id,
                'tanggal' => $request->tanggal_laporan
            ]);

            if (!empty($request->no_seri)) {
                $bool = true;
                for ($i = 0; $i < count($request->no_seri); $i++) {
                    $status = "";
                    if ($request->tindak_lanjut == "ok") {
                        $status = 'ok';
                    } else if ($request->tindak_lanjut == "perbaikan") {
                        $status = 'req_perbaikan';
                    } else if ($request->tindak_lanjut == "pengujian") {
                        $status = 'req_pengujian';
                    }
                    $cs = HasilPengemasan::create([
                        'pengemasan_id' => $c->id,
                        'hasil_perakitan_id' => $request->no_seri[$i],
                        'no_barcode' => $request->no_barcode[$i],
                        'hasil' => $request->hasil[$i],
                        'keterangan' => $request->keterangan[$i],
                        'tindak_lanjut' => $request->tindak_lanjut[$i],
                        'status' => $status
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
                $btn = '<a href = "/perbaikan/produksi/detail/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/perbaikan/produksi/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/perbaikan/produksi/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['produk', 'aksi'])
            ->make(true);
    }

    public function perbaikan_produksi_create($id, $proses)
    {
        $s = HasilPerakitan::find($id);
        $bppbid = $s->Perakitan->Bppb->id;
        $dp = $s->Perakitan->Bppb->detail_produk_id;
        $p = PartEng::whereHas(
            'BillOfMaterial',
            function ($q) use ($dp) {
                $q->where('detail_produk_id', $dp);
            }
        )->get();
        $k = Karyawan::whereNotIn('jabatan', ['direktur', 'manager'])->get();
        $hp = "";

        if ($proses == "perakitan") {
            $hp = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->whereIn('status', ['rej_pemeriksaan_terbuka', 'rej_pemeriksaan_tertutup'])
                ->orWhereIn('tindak_lanjut_terbuka', ['perbaikan'])
                ->orWhereIn('tindak_lanjut_tertutup', ['perbaikan'])
                ->get();
        } else if ($proses == "pengujian") {
            $hp = HasilMonitoringProses::whereHas('MonitoringProses', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->with('HasilPerakitan')->whereIn('status', ['req_perbaikan'])->get();
        } else if ($proses == "pengemasan") {
            $hp = HasilPengemasan::whereHas('Pengemasan', function ($q) use ($bppbid) {
                $q->where('bppb_id', $bppbid);
            })->with('HasilPerakitan')->whereIn('status', ['req_perbaikan'])->get();
        }
        return view('page.produksi.perbaikan_produksi_create', ['id' => $id, 's' => $s, 'k' => $k, 'p' => $p, 'hp' => $hp, 'proses' => $proses]);
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
                $p->HasilPerakitan()->sync($request->hasil_perakitan_id);
                $p->PartEng()->sync($request->part);
                $u = $p->save();

                if ($u) {
                    for ($i = 0; $i < count($request->hasil_perakitan_id); $i++) {
                        if ($request->ketidaksesuaian_proses == "perakitan") {
                            $h = HasilPerakitan::find($request->hasil_perakitan_id[$i]);
                            if ($h->status == "rej_pemeriksaan_terbuka") {
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
                            } else if ($h->status == "rej_pemeriksaan_tertutup") {
                                $h->status = "perbaikan_pemeriksaan_tertutup";
                                $h->save();
                            }
                        } else if ($request->ketidaksesuaian_proses == "pengujian") {
                            $h = HasilMonitoringProses::where('hasil_perakitan_id', $request->hasil_perakitan_id[$i])->first();
                            $u = HasilMonitoringProses::find($h->id);
                            $u->status = "acc_perbaikan";
                            $u->save();

                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                "kegiatan" => "perbaikan_pengujian",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "ok"
                            ]);
                        } else if ($request->ketidaksesuaian_proses == "pengemasan") {
                            $h = HasilPengemasan::where('hasil_perakitan_id', $request->hasil_perakitan_id[$i])->first();
                            $u = HasilPengemasan::find($h->id);
                            $u->status = "acc_perbaikan";
                            $u->save();

                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                "kegiatan" => "perbaikan_pengemasan",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "pengujian"
                            ]);

                            $mp_id = "";
                            $mp = MonitoringProses::where([['bppb_id', '=', $id], ['tanggal', '=', Carbon::now()->toDateString()]])->first();
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
                                'hasil_perakitan_id' => $request->hasil_perakitan_id[$i],
                                'keterangan' => 'pengujian pengemasan'
                            ]);
                        }
                    }
                    return redirect()->back()->with('success', "Berhasil menyimpan data Perbaikan");
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
            $p->HasilPerakitan()->sync($request->hasil_perakitan_id);
            $p->PartEng()->sync($request->part);
            $u = $p->save();

            if ($u) {
                for ($i = 0; $i < count($request->hasil_perakitan_id); $i++) {
                    if ($request->ketidaksesuaian_proses == "perakitan") {
                        $h = HasilPerakitan::find($request->hasil_perakitan_id[$i]);
                        if ($h->status == "rej_pemeriksaan_terbuka") {
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
                        } else if ($h->status == "rej_pemeriksaan_tertutup") {
                            $h->status = "perbaikan_pemeriksaan_tertutup";
                            $h->save();
                        }
                    } else if ($request->ketidaksesuaian_proses == "pengujian") {
                        $h = HasilMonitoringProses::where('hasil_perakitan_id', $request->hasil_perakitan_id[$i])->first();
                        $u = HasilMonitoringProses::find($h->id);
                        if ($u->status == "req_perbaikan") {
                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
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
                        $h = HasilPengemasan::where('hasil_perakitan_id', $request->hasil_perakitan_id[$i])->get();
                        $u = HasilPengemasan::find($h->id);
                        if ($u->status == "req_perbaikan") {
                            $c = HistoriHasilPerakitan::create([
                                "hasil_perakitan_id" => $request->hasil_perakitan_id[$i],
                                "kegiatan" => "perbaikan_pengemasan",
                                "tanggal" => Carbon::now()->toDateString(),
                                "hasil" => "ok",
                                "keterangan" => "",
                                "tindak_lanjut" => "pengujian"
                            ]);
                            $u->status = "acc_perbaikan";
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
                                'hasil_perakitan_id' => $request->hasil_perakitan_id[$i],
                                'keterangan' => 'pengujian pengemasan'
                            ]);
                        }
                    }
                }
                return redirect()->back()->with('success', "Berhasil menyimpan data Perbaikan");
            } else if (!$u) {
                return redirect()->back()->with('error', "Gagal menyimpan data Perbaikan");
            }
        }
    }
}
