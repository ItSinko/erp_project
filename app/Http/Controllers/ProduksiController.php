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
use App\Divisi;
use App\Perakitan;
use App\HasilPerakitan;
use App\HasilPerakitanKaryawan;
use App\HistoriHasilPerakitan;
use App\KelompokProduk;
use App\KategoriProduk;
use Carbon\Carbon;

use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\UserLogController;


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
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="purple-text">Produksi saat ini: ' . $s->countHasilPerakitan() . ' ' . $s->DetailProduk->satuan . '</small></div></hgroup>';
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
                    $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/req_pemeriksaan_tertutup"><button type="button" class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-paper-plane"></i></button>
                            <div><small> Permohonan Pemeriksaan Tertutup</small></div></a>
                            <div><small class="success-text">Pemeriksaan Terbuka Diterima</small></div>';
                } else if ($s->status == 'rej_pemeriksaan_terbuka') {
                    if ($s->tindak_lanjut_terbuka == "operator") {
                        $btn = '<a href="/perakitan/hasil/status/' . $s->id . '/perbaikan_pemeriksaan_terbuka"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
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
            } else {
                return redirect()->back();
            }
        }

        return redirect()->back();
    }

    public function perakitan_hasil_delete($id, Request $request)
    {
        $p = HasilPerakitan::where('id', $id)->first();
        $this->UserLogController->create(Auth::user()->id, "Hasil Perakitan " . $p->no_seri . ", untuk BPPB " . $p->Perakitan->Bppb->no_bppb, 'Hasil Perakitan', 'Hapus', $request->keterangan_log);

        $hp = HasilPerakitan::find($id);
        $hp->delete();

        return redirect()->back();
    }

    public function pengemasan()
    {
        return view('page.produksi.pengemasan_show');
    }

    public function pengemasan_show()
    {
        $p = array();
        if (Auth::user()->Divisi->nama == "Produksi") {
            $p = Bppb::has('pengemasan')->get();
        } else if (Auth::user()->Divisi->nama == "Quality Control") {
            $p = Bppb::whereHas('pengemasan', function ($query) {
                $query->whereNotIn('status', ['dibuat']);
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
                $btn = '<hgroup><h6 class="heading">' . $s->jumlah . " " . $s->DetailProduk->satuan . '</h6><div class="subheading "><small class="purple-text">Produksi saat ini: ' . $s->countHasilPerakitan() . ' ' . $s->DetailProduk->satuan . '</small></div></hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/pengemasan/laporan/' . $s->id . '" data-id="' . $s->id . '">';
                $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-info">';
                $btn .= '<span style="color:white;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Detail Laporan</span></button></a>';
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
    }

    public function pengemasan_laporan_show()
    {
    }
}
