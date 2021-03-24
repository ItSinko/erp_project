<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\Imports\HasilPerakitanImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Karyawan;
use App\User;
use App\Bppb;
use App\Produk;
use App\Divisi;
use App\Perakitan;
use App\HasilPerakitan;
use App\HasilPerakitanKaryawan;
use App\KelompokProduk;
use App\KategoriProduk;

use App\Http\Controllers\BppbController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\KelompokProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PerakitanController;
use App\Http\Controllers\HasilPerakitanController;
use App\Http\Controllers\HasilPerakitanKaryawanController;
use App\Http\Controllers\UserLogController;


class ProduksiController extends Controller
{
    protected $BppbController;
    protected $KategoriProdukController;
    protected $KelompokProdukController;
    protected $ProdukController;
    protected $NotifikasiController;
    protected $PerakitanController;
    protected $HasilPerakitanController;
    protected $HasilPerakitanKaryawanController;
    protected $KaryawanController;
    protected $UserLogController;

    public function __construct(
        BppbController $BppbController,
        KategoriProdukController $KategoriProdukController,
        KelompokProdukController $KelompokProdukController,
        ProdukController $ProdukController,
        NotifikasiController $NotifikasiController,
        PerakitanController $PerakitanController,
        HasilPerakitanController $HasilPerakitanController,
        HasilPerakitanKaryawanController $HasilPerakitanKaryawanController,
        KaryawanController $KaryawanController,
        UserLogController $UserLogController
    ) {
        $this->BppbController = $BppbController;
        $this->KategoriProdukController = $KategoriProdukController;
        $this->KelompokProdukController = $KelompokProdukController;
        $this->ProdukController = $ProdukController;
        $this->NotifikasiController = $NotifikasiController;
        $this->PerakitanController = $PerakitanController;
        $this->HasilPerakitanController = $HasilPerakitanController;
        $this->HasilPerakitanKaryawanController = $HasilPerakitanKaryawanController;
        $this->KaryawanController = $KaryawanController;
        $this->UserLogController = $UserLogController;
    }


    //PERAKITAN
    public function perakitan()
    {
        $p = array();
        $r = array();
        $i = 0;

        if (Auth::user()->Divisi->nama == "Produksi") {
            $p = Bppb::has('perakitan')->get();
        } else if (Auth::user()->Divisi->nama == "Quality Control") {
            $p = Bppb::whereHas('perakitan', function ($query) {
                $query->whereNotIn('status', ['0']);
            })->get();
        }
        return view('produksi.perakitan_show', ['r' => $r, 'p' => $p]);
    }

    public function tambah_perakitan()
    {
        $b = [];
        $i = 0;

        $be = $this->PerakitanController->show_all();

        foreach ($be as $bes) {
            $b[$i] = $bes->bppb_id;
            $i++;
        }

        $s = $this->BppbController->show_not_in($b, Auth::user()->divisi_id);
        $kry = $this->KaryawanController->show_all();
        return view('produksi.perakitan_create', ['s' => $s, 'kry' => $kry]);
    }

    public function store_perakitan(Request $request)
    {
        $v = "";
        if ((!empty($request->tanggal) || !empty($request->karyawan_id) || !empty($request->warna)) && !empty($request->file)) {
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
        } else if ((!empty($request->tanggal) || !empty($request->karyawan_id) || !empty($request->warna)) || !empty($request->file)) {
            if ((!empty($request->tanggal) || !empty($request->karyawan_id) || !empty($request->warna)) && empty($request->file)) {
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
            } else if ((empty($request->tanggal) && empty($request->karyawan_id) && empty($request->warna))  && !empty($request->file)) {
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
        } else if ((empty($request->tanggal) && empty($request->karyawan_id) && empty($request->warna)) && empty($request->file)) {
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
                            $s = $this->HasilPerakitanController->create($c->id, $request->tanggals[$i], $request->no_seri[$i], $request->warna[$i], NULL, NULL);

                            if (!$s) {
                                $bool = false;
                            } else {
                                $s->Karyawan()->sync($request->karyawan_id[$i], false);
                            }
                        }
                        if ($bool = true) {
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
                        $s = $this->HasilPerakitanController->create($c->id, $request->tanggals[$i], $request->no_seri[$i], $request->warna[$i], NULL, NULL);

                        if (!$s) {
                            $bool = false;
                        } else {
                            $s->Karyawan()->sync($request->karyawan_id[$i], false);
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

    public function tambah_laporan_perakitan($id)
    {
        $b = Bppb::find($id);
        $kry = Karyawan::all();
        return view('produksi.perakitan_create_laporan', ['b' => $b, 'id' => $id, 'kry' => $kry]);
    }

    public function store_laporan_perakitan($id, Request $request)
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
                            $s = $this->HasilPerakitanController->create($c->id, $request->tanggals[$i], $request->no_seri[$i], $request->warna[$i], NULL, NULL);
                            if (!$s) {
                                $bool = false;
                            } else {
                                $s->Karyawan()->sync($request->karyawan_id[$i], false);
                            }
                        }
                        if ($bool = true) {
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
                        $s = $this->HasilPerakitanController->create($c->id, $request->tanggals[$i], $request->no_seri[$i], $request->warna[$i], NULL, NULL);
                        if (!$s) {
                            $bool = false;
                        } else {
                            $s->Karyawan()->sync($request->karyawan_id[$i], false);
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

    public function edit_laporan_perakitan($id)
    {
        $sh = Perakitan::find($id);
        $kry = Karyawan::all();
        return view('produksi.perakitan_edit_laporan', ['id' => $id, 'sh' => $sh, 'kry' => $kry]);
    }

    public function update_laporan_perakitan($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal_laporan' => 'required',
                'no_seri' => 'required|unique:hasil_perakitans',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $p = Perakitan::find($id);
            $p->tanggal = $request->tanggal_laporan;
            $p->save();
            $bool = true;

            if ($p) {
                if (!empty($request->no_seri)) {
                    for ($i = 0; $i < count($request->no_seri); $i++) {
                        $hp = HasilPerakitan::find($request->id[$i]);
                        $hp->tanggal = $request->tanggals[$i];
                        $hp->no_seri = $request->no_seri[$i];
                        $hp->warna = $request->warna[$i];
                        $hp->Karyawan()->sync($request->karyawan_id[$i]);
                        $hp->save();
                        if (!$hp) {
                            $bool = false;
                        }
                    }
                    if ($bool = true) {
                        return redirect()->back()->with('success', "Berhasil mengubah Data");
                    } else if ($bool = false) {
                        return redirect()->back()->with('error', "Gagal mengubah Data");
                    }
                } else {
                    if ($bool = true) {
                        return redirect()->back()->with('success', "Berhasil mengubah Data");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }


        return redirect()->back()->with('success', "Berhasil mengupdate Data");
    }

    public function delete_perakitan($id, Request $request)
    {
        $p = Perakitan::find($id);
        $this->UserLogController->create(Auth::user()->id, "Perakitan " . $p->no_bppb, 'Perakitan', 'Hapus', $request->keterangan_log);
        $u = User::where('divisi_id', '14')->get();
        foreach ($u as $i) {
            $cs = $this->NotifikasiController->create("Perakitan", "telah menghapus Perakitan " . $p->no_bppb, Auth::user()->id, $i->id, "/perakitan");
        }
        $p->delete();

        return redirect('/perakitan')->with('success', "Berhasil menghapus data perakitan");
    }


    public function hasil_perakitan($id)
    {
        $sh = Perakitan::find($id);
        return view('produksi.perakitan_hasil_show', ['id' => $id, 'sh' => $sh]);
    }

    public function store_hasil_perakitan_import($id, Request $request)
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

    public function tambah_hasil_perakitan($id)
    {
        $sh = Perakitan::find($id);
        $k = Karyawan::all();

        return view('produksi.perakitan_hasil_create', ['id' => $id, 'sh' => $sh, 'k' => $k]);
    }

    public function store_hasil_perakitan($id, Request $request)
    {
        $s = true;
        $v = Validator::make(
            $request->all(),
            [
                'no_seri' => 'required|unique:hasil_perakitans',
            ],
            [
                'no_seri.unique' => 'No Seri sudah terpakai',
                'no_seri.required' => 'No Seri harus diisi'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            for ($i = 0; $i < count($request->no_seri); $i++) {
                $s = $this->HasilPerakitanController->create($request->id, $request->tanggals[$i], $request->no_seri[$i], $request->warna[$i], NULL, NULL);
                if (!$s) {
                    $s = false;
                }
            }
            if ($s = true) {
                return redirect()->back()->with('success', "Berhasil menambahkan Data");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Data");
            }
        }
    }

    public function edit_hasil_perakitan($id)
    {
        $s = HasilPerakitan::find($id);
        $kry = Karyawan::all();
        return view('produksi.perakitan_hasil_edit', ['id' => $id, 's' => $s, 'kry' => $kry]);
    }

    public function update_hasil_perakitan($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal' => 'required',
                'no_seri' => 'required|unique:hasil_perakitans,id,' . $id,
            ],
            [
                'tanggal.required' => 'Tanggal harus diisi',
                'no_seri.required' => 'No Seri harus diisi',
                'no_seri.unique' => 'No Seri sudah terpakai',
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $bool = true;
            $hp = HasilPerakitan::find($id);
            $hp->tanggal = $request->tanggal;
            $hp->no_seri = $request->no_seri;
            $hp->warna = $request->warna;

            $hp->Karyawan()->sync($request->karyawan_id);

            $hp->save();

            if (!$hp) {
                $bool = false;
            }

            if ($bool = true) {
                return redirect()->back()->with('success', "Berhasil mengubah Data");
            } else if ($bool = false) {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        }
    }

    public function delete_hasil_perakitan($id, Request $request)
    {
        $p = HasilPerakitan::where('id', $id)->first();
        $this->UserLogController->create(Auth::user()->id, "Hasil Perakitan " . $p->no_seri, 'Hasil Perakitan', 'Hapus', $request->keterangan_log);

        $hp = HasilPerakitan::find($id);
        $hp->delete();

        return redirect()->back();
    }
}
