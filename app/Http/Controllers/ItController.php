<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use App\DivisiInventory;
use App\Inventory;
use App\DetailInventory;
use App\Divisi;
use App\Karyawan;
use App\Produk;
use App\KelompokProduk;
use App\KategoriProduk;
use App\PeminjamanAlat;
use App\DetailPeminjamanKaryawan;
use App\DetailProduk;
use Carbon\Carbon;
use App\Http\Controllers\GetController;
use App\Http\Controllers\UserLogController;
use App\PeminjamanKaryawan;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ItController extends Controller
{
    protected $GetController;
    protected $UserLogController;
    public function __construct(GetController $GetController, UserLogController $UserLogController)
    {
        $this->GetController = $GetController;
        $this->UserLogController = $UserLogController;
    }

    public function template_form_delete()
    {
        return view('page.common.template_form_delete');
    }

    public function form_template()
    {
        return view('page.it.template_form');
    }

    //PRODUK
    public function produk()
    {
        return view('page.it.produk_show');
    }

    public function produk_show()
    {
        $s = Produk::all();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('kategori_id', function ($s) {
                $btn = '<hgroup><h6 class="heading">' . $s->tipe . ' - ' . $s->nama . '</h6>';
                $btn .= '<div class="subheading text-muted">' . $s->KategoriProduk['nama'] . '</div></hgroup>';
                return $btn;
            })
            ->editColumn('kelompok_produk_id', function ($s) {
                return  $s->KelompokProduk['nama'];
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail produk"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/produk/detail/show/' . $s->id . '" data-id="' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Detail</span></a>';
                $btn .= '<a class="dropdown-item" href="/produk/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/produk/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->rawColumns(['kategori_id', 'aksi'])
            ->make(true);
    }

    public function produk_detail()
    {
        return view('page.it.produk_detail_show');
    }

    public function produk_detail_show($id)
    {
        $s = DetailProduk::where('produk_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail produk"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">';
                $btn .= '<a class="dropdown-item" href="/produk/detail/edit/' . $s->id . '"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>';
                $btn .= '<a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/produk/detail/delete/' . $s->id . '"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a></div>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function produk_create()
    {
        $k = KelompokProduk::all();
        return view('page.it.produk_create', ['k' => $k]);
    }

    public function produk_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'kode_barcode' => 'required|max:50',
                'nama' => 'required|max:255',
                'tipe' => 'required|max:100|unique:produks',
            ],
            [
                'kode_barcode.required' => "Kode Barcode harus diisi",
                'tipe.required' => "Tipe harus diisi",
                'nama.required' => "Nama harus diisi",
                'kode_barcode.max' => "Kode Barcode tidak boleh lebih dari 50 karakter",
                'nama.max' => "Nama tidak boleh lebih dari 255 karakter",
                'tipe.max' => "Tipe tidak boleh lebih dari 100 karakter",
                'tipe.unique' => "Tipe sudah terpakai",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = Produk::create([
                'kelompok_produk_id' => $request->kelompok_produk_id,
                'kategori_id' => $request->kategori_id,
                'merk' => $request->merk,
                'tipe' => $request->tipe,
                'nama' => $request->nama,
                'kode_barcode' => $request->kode_barcode,
                'nama_coo' => $request->nama_coo,
                'no_akd' => $request->no_akd,
                'keterangan' => $request->keterangan,
                'status' => 'show'
            ]);
            if ($c) {
                $bool = true;
                for ($i = 0; $i < count($request->nama_detail1); $i++) {
                    $cs = DetailProduk::create([
                        'produk_id' => $c->id,
                        'kode' => $request->kode[$i],
                        'nama' => $request->nama_detail1[$i] . " + " . $request->nama_detail2[$i],
                        'harga' => $request->harga[$i],
                        'berat' => $request->berat[$i],
                        'satuan' => $request->satuan[$i],
                        'keterangan' => $request->keterangan_detail[$i],
                        'status' => 'ada'
                    ]);
                    if (!$cs) {
                        $bool = false;
                    }
                }
                if ($bool == true) {
                    $this->UserLogController->create(Auth::user()->id, $request->tipe, 'Produk', 'Tambah', "");
                    return redirect()->back()->with('success', "Berhasil menambahkan Produk");
                } else if ($bool == false) {
                    return redirect()->back()->with('error', "Gagal menambahkan Produk");
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Produk");
            }
        }
    }

    public function produk_edit($id)
    {
        $k = KelompokProduk::all();
        $kp = KategoriProduk::all();
        $p = Produk::find($id);
        return view('page.it.produk_edit', ['id' => $id, 'k' => $k, 'kp' => $kp, 'p' => $p]);
    }

    public function produk_update($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'kode_barcode' => 'required|max:50',
                'nama' => 'required|max:255',
                'tipe' => 'required|max:100|unique:produks,id,' . $id,
            ],
            [
                'kode_barcode.required' => "Kode Barcode harus diisi",
                'tipe.required' => "Tipe harus diisi",
                'nama.required' => "Nama harus diisi",
                'kode_barcode.max' => "Kode Barcode tidak boleh lebih dari 50 karakter",
                'nama.max' => "Nama tidak boleh lebih dari 255 karakter",
                'tipe.max' => "Tipe tidak boleh lebih dari 100 karakter",
                'tipe.unique' => "Tipe sudah terpakai",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $p = Produk::find($id);
            $p->kelompok_produk_id = $request->kelompok_produk_id;
            $p->kategori_id = $request->kategori_id;
            $p->merk = $request->merk;
            $p->tipe = $request->tipe;
            $p->nama = $request->nama;
            $p->foto = NULL;
            $p->kode = $request->kode;
            $p->kode_barcode = $request->kode_barcode;
            $p->berat = $request->berat;
            $p->satuan = $request->satuan;
            $p->nama_coo = $request->nama_coo;
            $p->no_akd = $request->no_akd;
            $p->keterangan = $request->keterangan;
            $p->save();

            if ($p) {
                $this->UserLogController->create(Auth::user()->id, $request->tipe, 'Produk', 'Ubah', "");
                return redirect()->back()->with('success', "Berhasil mengubah Produk");
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Produk");
            }
        }
    }

    public function produk_delete($id, Request $request)
    {
        $p = Produk::find($id);
        $this->UserLogController->create(Auth::user()->id, $p->tipe, 'Produk', 'Hapus', $request->keterangan_log);
        $p->delete();
        return redirect()->back();
    }


    //INVENTORY
    public function inventory_divisi()
    {
        return view('page.it.inventory_divisi_show');
    }

    public function inventory_divisi_show()
    {
        $s = DivisiInventory::all();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('divisi', function ($s) {
                return $s->divisi['nama'];
            })
            ->editColumn('pic', function ($s) {
                return $s->karyawan['nama'];
            })
            ->addColumn('aksi', function ($s) {
                $btnaksi = '<a href = "/inventory/' . $s->divisi_id . '"><button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button></a>';
                return $btnaksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function inventory_create($divisi_id)
    {
        $p = Karyawan::where('divisi_id', $divisi_id)->get();
        return view('page.it.inventory_create', ['divisi_id' => $divisi_id, 'p' => $p]);
    }

    public function inventory_store(Request $request, $divisi_id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'kode' => 'required',
                'pic_id' => 'required',
                'kode_barang.*' => 'required',
                'nama_barang.*' => 'required',
                'jumlah.*' => 'required',
                'masa_manfaat.*' => 'required',
                'kondisi.*' => 'required',
                'harga_perolehan.*' => 'required',
            ],
            [
                'kode.required' => "Kode harus diisi",
                'pic_id.required' => "Penanggung Jawab harus diisi",
                'kode_barang.*.required' => "Kode Barang harus diisi",
                'nama_barang.*.required' => "Nama Barang harus diisi",
                'jumlah.*.required' => "Jumlah harus diisi",
                'masa_manfaat.*.required' => "Masa Manfaat harus diisi",
                'kondisi.*.required' => "Kondisi harus diisi",
                'harga_perolehan.*.required' => "Harga Perolehan harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = DivisiInventory::create([
                'kode' => $request->kode,
                'divisi_id' => $divisi_id,
                'pic_id' => $request->pic_id
            ]);
            if ($c) {
                if (!empty($request->kode_barang)) {
                    $bool = true;
                    for ($i = 0; $i < count($request->kode_barang); $i++) {
                        $ic = Inventory::create([
                            'divisi_inventory_id' => $c->id,
                            'kode_barang' => $request->kode_barang[$i],
                            'merk' => $request->merk[$i],
                            'nama_barang' => $request->nama_barang[$i],
                            'lokasi' => $request->lokasi[$i],
                            'tanggal_perolehan' => $request->tanggal_perolehan[$i],
                            'jumlah' => $request->jumlah[$i],
                            'masa_manfaat' => $request->masa_manfaat[$i],
                            'kondisi' => $request->kondisi[$i],
                            'harga_perolehan' => $request->harga_perolehan[$i],
                            'keterangan' => $request->keterangan[$i],
                            'status' => 'tersedia'
                        ]);

                        if (!$ic) {
                            $bool = false;
                        }
                    }
                    if ($bool = true) {
                        return redirect()->back()->with('success', "Berhasil menambah Produk");
                    } else if ($bool = false) {
                        return redirect()->back()->with('error', "Gagal menambah Produk");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambah Produk");
            }
        }
    }

    public function inventory_edit($id)
    {
        $s = Inventory::find($id);
        return view('page.it.inventory_edit', ['s' => $s, 'id' => $id]);
    }

    public function inventory_update(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'kode_barang' => 'required',
                'nama_barang' => 'required',
                'jumlah' => 'required',
                'masa_manfaat' => 'required',
                'kondisi' => 'required',
                'harga_perolehan' => 'required',
            ],
            [
                'kode_barang.required' => "Kode Barang harus diisi",
                'nama_barang.required' => "Nama Barang harus diisi",
                'jumlah.required' => "Jumlah harus diisi",
                'masa_manfaat.required' => "Masa Manfaat harus diisi",
                'kondisi.required' => "Kondisi harus diisi",
                'harga_perolehan.required' => "Harga Perolehan harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $i = Inventory::find($id);
            $i->kode_barang = $request->kode_barang;
            $i->merk = $request->merk;
            $i->nama_barang = $request->nama_barang;
            $i->lokasi = $request->lokasi;
            $i->tanggal_perolehan = $request->tanggal_perolehan;
            $i->jumlah = $request->jumlah;
            $i->masa_manfaat = $request->masa_manfaat;
            $i->kondisi = $request->kondisi;
            $i->harga_perolehan = $request->harga_perolehan;
            $i->keterangan = $request->keterangan;
            $i->save();

            if ($i) {
                return redirect()->back()->with('success', "Berhasil menambah Produk");
            } else {
                return redirect()->back()->with('error', "Gagal menambah Produk");
            }
        }
    }

    public function inventory()
    {
        $divisi_id = Auth::user()->divisi_id;
        return view('page.it.inventory_show', ['divisi_id' => $divisi_id]);
    }

    public function inventory_show($divisi_id)
    {
        $s = Inventory::whereHas('DivisiInventory', function ($q)  use ($divisi_id) {
            $q->where('divisi_id', $divisi_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('nama_barang', function ($s) {
                $sum = PeminjamanAlat::where([['inventory_id', '=', $s->id], ['status', '=', 'wishlist']])->sum('jumlah');
                $btn = '<hgroup><h6 class="heading">' . $s->kode_barang . ' - ' . $s->nama_barang . '</h6>';
                if ($sum > 0) {
                    $btn .= '<div class="subheading"><small class="purple-text">Wishlist Peminjaman : ' . $sum . '</small></div>';
                }
                $btn .= '</hgroup>';
                return $btn;
            })
            ->editColumn('tanggal_perolehan', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal_perolehan)->format('d/m/Y');
            })
            ->editColumn('status', function ($s) {
                return ucfirst($s->status);
            })
            ->editColumn('harga_perolehan', function ($s) {
                return $s->harga_perolehan;
            })
            ->addColumn('nilai_penyusutan', function ($s) {
                // return round($this->GetController->inventory_nilai_penyusutan($s->harga_perolehan, $s->jumlah, $s->masa_manfaat));
                return $s->nilai_penyusutan();
            })
            ->addColumn('akum_nilai_penyusutan', function ($s) {
                // return round($this->GetController->inventory_akum_nilai_penyusutan($s->harga_perolehan, $s->jumlah, $s->masa_manfaat, $s->tanggal_perolehan));
                return $s->akum_nilai_penyusutan();
            })
            ->addColumn('nilai_sisa_buku', function ($s) {
                // return round($this->GetController->inventory_nilai_sisa_buku($s->harga_perolehan, $s->jumlah, $s->masa_manfaat, $s->tanggal_perolehan));
                $btn = $s->nilai_sisa_buku();
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btnedit = '<a href = "/inventory/edit/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                $btndelete = '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/inventory/delete/' . $s->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                $btnaksi = $btnedit . $btndelete;
                return $btnaksi;
            })
            ->rawColumns(['aksi', 'nilai_sisa_buku', 'akum_nilai_penyusutan', 'harga_perolehan', 'nama_barang'])
            ->make(true);
    }

    public function inventory_delete($id,  Request $request)
    {
        $p = Inventory::find($id);
        $this->UserLogController->create(Auth::user()->id, $p->kode_barang . " " . $p->nama_barang, 'Inventory', 'Hapus', $request->keterangan_log);
        $p->delete();
        return redirect()->back();
    }


    //PEMINJAMAN
    public function peminjaman_alat()
    {
        return view('page.it.peminjaman_alat_show');
    }

    public function peminjaman_alat_show()
    {
        $user_divisi = Auth::user()->divisi_id;
        $s = PeminjamanAlat::whereHas('User', function ($q) use ($user_divisi) {
            $q->where('divisi_id', $user_divisi);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal_pengajuan', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal_pengajuan)->format('d/m/Y');
            })
            ->editColumn('tanggal_perpanjangan', function ($s) {
                if (!empty($s->tanggal_perpanjangan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_perpanjangan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_pengembalian', function ($s) {
                if (!empty($s->tanggal_pengembalian)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_pengembalian)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_peminjaman', function ($s) {
                if (!empty($s->tanggal_peminjaman)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_peminjaman)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_batas_pengembalian', function ($s) {
                if (!empty($s->tanggal_batas_pengembalian)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_batas_pengembalian)->format('d/m/Y');
                }
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                $due = "";

                if (!empty($s->tanggal_batas_pengembalian)) {
                    $due_date = Carbon::parse($s->tanggal_batas_pengembalian);
                    $today_date = Carbon::now();
                    $res =  $today_date->diffInDays($due_date, false);

                    if ($res <= 3) {
                        $due .= '<p><a href = "/peminjaman/alat/status/' . $s->id . '/permintaan_perpanjangan"><button class="btn btn-primary btn-round btn-sm"><i class="fa fa-paper-plane"></i>&nbsp;Wishlist</button></a></p>';
                    }
                }

                if ($s->status == "draft") {
                    if ($s->inventory->jumlah_tersedia >= $s->jumlah) {
                        $btn = '<a href = "/peminjaman/alat/status/' . $s->id . '/menunggu"><button class="btn btn-info btn-round btn-sm"><i class="fa fa-paper-plane"></i>&nbsp;Pinjam</button></a>';
                    } else {
                        $btn = '<a href = "/peminjaman/alat/status/' . $s->id . '/wishlist" title="Barang tidak tersedia, Masukkan wishlist untuk info ketersediaan barang"><button class="btn btn-primary btn-round btn-sm"><i class="fas fa-heart"></i>&nbsp;Wishlist</button></a>';
                    }
                } else if ($s->status == "wishlist") {
                    $btn = '<span class="purple-text">Wishlist</span>';
                    if ($s->inventory->jumlah_tersedia >= $s->jumlah) {
                        $btn .= '<a href = "/peminjaman/alat/status/' . $s->id . '/menunggu" title="Barang sudah tersedia, Silahkan melakukan peminjaman"><button class="btn btn-info btn-round btn-sm"><i class="fa fa-paper-plane"></i>&nbsp;Pinjam</button></a>';
                    }
                } else if ($s->status == "menunggu") {
                    $btn = '<span class="warning-text">Menunggu</span>';
                } else if ($s->status == "dipinjam") {
                    $btn = '<span class="success-text">Dipinjam</span>';
                    $btn .= $due;
                } else if ($s->status == "tolak") {
                    $btn = '<span class="danger-text">Tolak</span>';
                } else if ($s->status == "permintaan_perpanjangan") {
                    $btn = '<span class="danger-text">Permintaan Perpanjangan</span>';
                } else if ($s->status == "perpanjangan") {
                    $btn = '<span class="success-text">Dipinjam</span>';
                    $btn .= $due;
                } else if ($s->status == "tolak_perpanjangan") {
                    $btn = `<span class="success-text">Dipinjam</span>
                            <p><span class="danger-text">Tolak Perpanjangan</span></p>`;
                } else if ($s->status == "kembali") {
                    $btn = '<span class="secondary-text">Kembali</span>';
                }
                return $btn;
            })
            ->addColumn('divisi', function ($s) {
                $btn = $s->DivisiInventory->Divisi->nama;
                return $btn;
            })
            ->editColumn('inventory', function ($s) {
                $btn = $s->Inventory->nama_barang;
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if (Auth::user()->id === $s->peminjam_id) {
                    if ($s->status == "draft" || $s->status == "wishlist") {
                        $btn = '<a href = "/peminjaman/alat/edit/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                        $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/peminjaman/alat/delete/' . $s->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                    }
                }
                return $btn;
            })
            ->editColumn('keterangan', function ($s) {
                $btn = $s->keterangan;
                if (!empty($s->tanggal_batas_pengembalian)) {
                    $due_date = Carbon::parse($s->tanggal_batas_pengembalian);
                    $today_date = Carbon::now();
                    $res =  $today_date->diffInDays($due_date, false);
                    if ($res >= 1 && $res <= 3) {
                        $btn .= '<p><span class="warning-text">Batas Pengembalian ' . $res . ' hari lagi</span></p>';
                    } else if ($res < 1) {
                        $btn .= '<p><span class="danger-text">Waktu telah habis, Silahkan lakukan pengembalian barang</span></p>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['aksi', 'status', 'keterangan'])
            ->make(true);
    }

    public function peminjaman_alat_create()
    {
        $d = DivisiInventory::all();
        return view('page.it.peminjaman_alat_create', ['d' => $d]);
    }

    public function peminjaman_alat_store(Request $request, $user_id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'tanggal_pengajuan' => 'required',
                'divisi_inventory_id' => 'required',
                'inventory_id' => 'required',
                'jumlah' => 'required',
            ],
            [

                'tanggal_pengajuan.required' => "Tanggal pengajuan harus diisi",
                'divisi_inventory_id.required' => "Pilih Inventory milik Divisi",
                'inventory_id.required' => "Pilih Kode Barang",
                'jumlah.required' => "Jumlah harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {

            $bool = true;
            for ($i = 0; $i < count($request->divisi_inventory_id); $i++) {
                $cs = PeminjamanAlat::create([
                    'divisi_inventory_id' => $request->divisi_inventory_id[$i],
                    'inventory_id' => $request->inventory_id[$i],
                    'jumlah' => $request->jumlah[$i],
                    'keterangan' => $request->keteranganinv[$i],
                    'tanggal_pengajuan' => $request->tanggal_pengajuan,
                    'peminjam_id' => $user_id,
                    'status' => "draft"
                ]);
                if (!$cs) {
                    $bool = false;
                }
            }
            if ($bool == true) {
                return redirect()->back()->with('success', 'Sukses menambahkan Data');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan Data');
            }
        }
    }

    public function peminjaman_alat_edit($id)
    {
        $d = DivisiInventory::all();
        $s = PeminjamanAlat::find($id);
        return view('page.it.peminjaman_alat_edit', ['id' => $id, 'd' => $d, 's' => $s]);
    }

    public function peminjaman_alat_update(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'divisi_inventory_id' => 'required',
                'inventory_id' => 'required',
                'jumlah' => 'required',
            ],
            [
                'divisi_inventory_id.required' => "Pilih Inventory milik Divisi",
                'inventory_id.required' => "Pilih Kode Barang",
                'jumlah.required' => "Jumlah harus diisi",
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $i = PeminjamanAlat::find($id);
            $i->divisi_inventory_id = $request->divisi_inventory_id;
            $i->inventory_id = $request->inventory_id;
            $i->jumlah = $request->jumlah;
            $i->keterangan = $request->keteranganinv;
            $s = $i->save();

            if ($s) {
                return redirect()->back()->with('success', 'Sukses mengubah Data');
            } else {
                return redirect()->back()->with('error', 'Gagal mengubah Data');
            }
        }
    }

    public function peminjaman_alat_delete(Request $request, $id)
    {
        $p = PeminjamanAlat::find($id);
        $this->UserLogController->create(Auth::user()->id,  "Peminjaman oleh " . $p->User->nama . " ke Inventory milik " . $p->DivisiInventory->Divisi->nama . " tanggal " . $p->tanggal_peminjaman, 'Peminjaman', 'Hapus', $request->keterangan_log);
        $p->delete();
        return redirect()->back();
    }

    public function peminjaman_alat_status($id, $status)
    {
        $date = Carbon::now();
        $p = PeminjamanAlat::find($id);

        if ($status == "dipinjam") {
            $p->status = $status;
            $p->tanggal_peminjaman = $date->toDateString();
            $date->addDays(9);
            $p->tanggal_batas_pengembalian = $date;
            $u = $p->save();
            if ($u) {
                $i = Inventory::find($p->inventory_id);
                $i->jumlah_tersedia = $i->jumlah_tersedia - $p->jumlah;
                $i->save();

                return redirect()->back();
            }
        } else if ($status == "perpanjangan") {
            $p->status = $status;
            $p->tanggal_perpanjangan = $date->toDateString();
            $date->addDays(9);
            $p->tanggal_batas_pengembalian = $date;
            $u = $p->save();

            return redirect()->back();
        } else if ($status == "kembali") {
            $p->status = $status;
            $p->tanggal_pengembalian = $date;
            $u = $p->save();
            if ($u) {
                $i = Inventory::find($p->inventory_id);
                $i->jumlah_tersedia = $i->jumlah_tersedia + $p->jumlah;
                $i->save();
                return redirect()->back();
            }
        } else {
            $p->status = $status;
            $u = $p->save();
            return redirect()->back();
        }
    }

    public function peminjaman_karyawan()
    {
        return view('page.it.peminjaman_karyawan_show');
    }

    public function peminjaman_karyawan_show()
    {
        $user_id = Auth::user()->id;
        $s = PeminjamanKaryawan::where('user_id', $user_id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('nama_penugasan', function ($s) {
                return $s->nama_penugasan;
            })
            ->addColumn('penanggung_jawab', function ($s) {
                return $s->PenanggungJawab->nama;
            })
            ->editColumn('tanggal_pembuatan', function ($s) {
                if (!empty($s->tanggal_pembuatan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_pembuatan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_penugasan', function ($s) {
                if (!empty($s->tanggal_penugasan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_penugasan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_selesai', function ($s) {
                if (!empty($s->tanggal_selesai)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_selesai)->format('d/m/Y');
                } else {
                    $btn = '<a href = "/peminjaman/karyawan/status/' . $s->id . '/selesai"><button class="btn btn-success btn-sm m-1"><i class="fas fa-check"></i>&nbsp;Selesai</button></a>';
                    $btn .= '<p><small class="purple-text">Estimasi Selesai: ' . Carbon::createFromFormat('Y-m-d', $s->tanggal_estimasi_selesai)->format('d/m/Y') . '</small></p>';
                    return $btn;
                }
            })
            ->editColumn('keterangan', function ($s) {
                $btn = $s->keterangan;
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/peminjaman/karyawan/detail/' . $s->id . '" data-id="' . $s->id . '"><button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button></a>';
                $btn .= '<a href = "/peminjaman/karyawan/edit/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/peminjaman/karyawan/delete/' . $s->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['aksi', 'tanggal_selesai'])
            ->make(true);
    }

    public function peminjaman_karyawan_create()
    {
        // $p = Karyawan::whereNotIn('divisi_id', [Auth::user()->divisi_id])->get();
        $p = Karyawan::all();
        return view('page.it.peminjaman_karyawan_create', ['p' => $p]);
    }

    public function peminjaman_karyawan_store(Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'nama_penugasan' => 'required',
                'lokasi_penugasan' => 'required',
                'penanggung_jawab_id' => 'required',
                'tanggal_penugasan' => 'required',
                'tanggal_estimasi_selesai' => 'required',
                'karyawan_id' => 'required'
            ],
            [

                'nama_penugasan.required' => "Nama Pekerjaan harus diisi",
                'lokasi_penugasan.required' => "Lokasi Penugasan harus diisi",
                'penanggung_jawab_id.required' => "Pilih Penanggung Jawab",
                'tanggal_penugasan.required' => "Tanggal Penugasan harus diisi",
                'tanggal_estimasi_selesai.required' => "Estimasi Selesai harus diisi",
                'karyawan_id' => 'Karyawan harus diisi'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = PeminjamanKaryawan::create([
                'nama_penugasan' => $request->nama_penugasan,
                'lokasi_penugasan' => $request->lokasi_penugasan,
                'penanggung_jawab_id' => $request->penanggung_jawab_id,
                'user_id' => Auth::user()->id,
                'tanggal_pembuatan' => Carbon::now(),
                'tanggal_penugasan' => $request->tanggal_penugasan,
                'tanggal_estimasi_selesai' => $request->tanggal_estimasi_selesai,
                'keterangan' => $request->keterangan,

            ]);

            if ($c) {
                $karyawan = array();
                for ($i = 0; $i < count($request->karyawan_id); $i++) {
                    $karyawan[$request->karyawan_id[$i]] = ['keterangan' => $request->keterangan_detail[$i]];
                }

                $cs = PeminjamanKaryawan::find($c->id);
                $cs->Karyawan()->sync($karyawan);
                $l = $cs->save();

                if ($l) {
                    return redirect()->back()->with('success', 'Sukses menambah Data');
                } else {
                    return redirect()->back()->with('error', 'Gagal menambah Data');
                }
            }
        }
    }

    public function peminjaman_karyawan_edit($id)
    {
        $s = PeminjamanKaryawan::find($id);
        $p = Karyawan::all();
        return view('page.it.peminjaman_karyawan_edit', ['s' => $s, 'id' => $id, 'p' => $p]);
    }

    public function peminjaman_karyawan_update(Request $request, $id)
    {
        $v = Validator::make(
            $request->all(),
            [
                'nama_penugasan' => 'required',
                'lokasi_penugasan' => 'required',
                'penanggung_jawab_id' => 'required',
                'tanggal_penugasan' => 'required',
                'tanggal_estimasi_selesai' => 'required',
                'karyawan_id' => 'required'
            ],
            [
                'nama_penugasan.required' => "Nama Pekerjaan harus diisi",
                'lokasi_penugasan.required' => "Lokasi Penugasan harus diisi",
                'penanggung_jawab_id.required' => "Pilih Penanggung Jawab",
                'tanggal_penugasan.required' => "Tanggal Penugasan harus diisi",
                'tanggal_estimasi_selesai.required' => "Estimasi Selesai harus diisi",
                'karyawan_id' => 'Karyawan harus diisi'
            ]
        );

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $karyawan = array();
            for ($i = 0; $i < count($request->karyawan_id); $i++) {
                $karyawan[$request->karyawan_id[$i]] = ['keterangan' => $request->keterangan_detail[$i]];
            }

            $u = PeminjamanKaryawan::find($id);
            $u->nama_penugasan = $request->nama_penugasan;
            $u->lokasi_penugasan = $request->lokasi_penugasan;
            $u->penanggung_jawab_id = $request->penanggung_jawab_id;
            $u->tanggal_penugasan = $request->tanggal_penugasan;
            $u->tanggal_estimasi_selesai = $request->tanggal_estimasi_selesai;
            $u->keterangan = $request->keterangan;
            $u->Karyawan()->sync($karyawan);
            $up = $u->save();

            if ($up) {
                return redirect()->back()->with('success', 'Sukses mengubah Data');
            } else {
                return redirect()->back()->with('error', 'Gagal mengubah Data');
            }
        }
    }

    public function peminjaman_karyawan_delete(Request $request, $id)
    {
        $p = PeminjamanKaryawan::find($id);
        $this->UserLogController->create(Auth::user()->id, $p->nama_penugasan . " tanggal" . $p->tanggal_penugasan . ", dengan Penanggung Jawab " . $p->penanggungjawab->nama, 'Peminjaman Karyawan', 'Hapus', $request->keterangan_log);
        $d = $p->delete();
        if ($bool = true) {
            return redirect()->back()->with('success', 'Sukses menghapus Data');
        } else if ($bool = false) {
            return redirect()->back()->with('error', 'Gagal menghapus Data');
        }
    }

    public function peminjaman_karyawan_status($id, $status)
    {
        if ($status == "selesai") {
            $p = PeminjamanKaryawan::find($id);
            $p->tanggal_pemberhentian = Carbon::now();
            $u = $p->save();
            if ($u) {
                return redirect()->back()->with('success', 'Sukses menghapus Data');
            } else if (!$u) {
                return redirect()->back()->with('error', 'Gagal menghapus Data');
            }
        }
    }

    public function peminjaman_karyawan_detail($id)
    {
        return view('page.it.peminjaman_karyawan_detail_show', ['id' => $id]);
    }

    public function peminjaman_karyawan_detail_show($id)
    {
        $s = PeminjamanKaryawan::find($id);
        return DataTables::of($s->Karyawan)
            ->addIndexColumn()
            ->editColumn('karyawan_id', function ($s) {
                return $s->nama;
            })
            ->editColumn('keterangan', function ($s) {
                return $s->pivot->keterangan;
            })
            ->editColumn('status', function ($s) use ($id) {
                $btn = "";
                if ($s->pivot->status == "draft") {
                    $btn = '<a href = "/peminjaman/karyawan/detail/status/' . $id . '/' . $s->id . '/menunggu"><button class="btn btn-info btn-sm m-1"><i class="far fa-paper-plane"></i>&nbsp;Meminta Persetujuan</button></a>';
                } else if ($s->pivot->status == 'menunggu') {
                    $btn = '<span class="warning-text">Menunggu</span>';
                } else if ($s->pivot->status == 'terima') {
                    $btn = '<span class="warning-text">Diterima</span>';
                } else if ($s->pivot->status == 'tolak') {
                    $btn = '<span class="warning-text">Ditolak</span>';
                } else if ($s->pivot->status == 'berhenti') {
                    $btn = '<span class="warning-text">Berhenti</span>';
                }
                return $btn;
            })
            ->addColumn('aksi', function ($s) use ($id) {
                $btn = '<a class="editdetailmodal" data-toggle="modal" data-target="#editdetailmodal" data-attr="/peminjaman/karyawan/detail/edit/' . $id . '/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/peminjaman/karyawan/delete/' . $s->pivot->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['aksi', 'status'])
            ->make(true);
    }

    public function peminjaman_karyawan_detail_edit($id, $karyawan_id)
    {
        $p = PeminjamanKaryawan::find($id);
        $s = $p->karyawan()->where('karyawan_id', $karyawan_id)->first();
        return view('page.it.peminjaman_karyawan_detail_edit', ['id' => $id, 'karyawan_id' => $karyawan_id, 's' => $s]);
    }

    public function peminjaman_karyawan_detail_update(Request $request, $id, $karyawan_id)
    {
        $k = PeminjamanKaryawan::find($id);
        $u = $k->Karyawan()->updateExistingPivot($karyawan_id, ['keterangan' => $request->keterangan]);

        if ($u) {
            return redirect()->back()->with('success', 'Sukses mengubah Data');
        } else if (!$u) {
            return redirect()->back()->with('error', 'Gagal mengubah Data');
        }
    }

    public function peminjaman_karyawan_detail_status($id, $karyawan_id, $status)
    {
        $k = PeminjamanKaryawan::find($id);
        if ($status == "berhenti") {
            $k->Karyawan()->updateExistingPivot($karyawan_id, ['status' => $status, 'tanggal_pemberhentian' => Carbon::now()]);
        } else {
            $k->Karyawan()->updateExistingPivot($karyawan_id, ['status' => $status]);
        }
    }

    public function inventory_peminjaman()
    {
        return view('page.it.inventory_peminjaman_show');
    }

    public function inventory_peminjaman_show()
    {
        $divisi = Auth::user()->Divisi->id;
        $s = PeminjamanAlat::whereHas('DivisiInventory', function ($q) use ($divisi) {
            $q->where('divisi_id', $divisi);
        })->whereNotIn('status', ['draft', 'wishlist'])->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal_pengajuan', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal_pengajuan)->format('d/m/Y');
            })
            ->editColumn('tanggal_perpanjangan', function ($s) {
                if (!empty($s->tanggal_perpanjangan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_perpanjangan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_pengembalian', function ($s) {
                if (!empty($s->tanggal_pengembalian)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_pengembalian)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_peminjaman', function ($s) {
                if (!empty($s->tanggal_peminjaman)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_peminjaman)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_batas_pengembalian', function ($s) {
                if (!empty($s->tanggal_batas_pengembalian)) {
                    return Carbon::createFromFormat('Y-m-d', $s->tanggal_batas_pengembalian)->format('d/m/Y');
                }
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                if ($s->status == "menunggu") {
                    $btn = '<a href = "/peminjaman/alat/status/' . $s->id . '/dipinjam"><button class="btn btn-success btn-round btn-sm"><i class="fas fa-check"></i>&nbsp;Terima</button></a>&nbsp;';
                    $btn .= '<a href = "/peminjaman/alat/status/' . $s->id . '/tolak"><button class="btn btn-danger btn-round btn-sm"><i class="fas fa-times"></i>&nbsp;Tolak</button></a>';
                } else if ($s->status == "dipinjam") {
                    $btn = '<p><a href = "/peminjaman/alat/status/' . $s->id . '/kembali"><button class="btn btn-secondary btn-round btn-sm"><i class="fas fa-exchange-alt"></i>&nbsp;Kembali</button></a></p>';
                    $btn .= '<p><span class="success-text">Dipinjam</span></p>';
                } else if ($s->status == "tolak") {
                    $btn = '<span class="danger-text">Tolak</span>';
                } else if ($s->status == "permintaan_perpanjangan") {
                    $btn = '<a href = "/peminjaman/alat/status/' . $s->id . '/permintaan_perpanjangan"><button class="btn btn-success btn-round btn-sm"><i class="fas fa-times"></i>&nbsp;Terima Perpanjangan</button></a>&nbsp;';
                    $btn .= '<a href = "/peminjaman/alat/status/' . $s->id . '/tolak_perpanjangan"><button class="btn btn-success btn-round btn-sm"><i class="fas fa-times"></i>&nbsp;Tolak Perpanjangan</button></a>';
                } else if ($s->status == "perpanjangan") {
                    $btn = '<span class="success-text">Dipinjam</span>';
                    $btn .= '<p><span><a href = "/peminjaman/alat/status/' . $s->id . '/kembali"><button class="btn btn-secondary btn-round btn-sm"><i class="fas fa-times"></i>&nbsp;Kembali</button></a></span></p>';
                } else if ($s->status == "tolak_perpanjangan") {
                    $btn = '<p><span class="success-text">Dipinjam</span></p>';
                    $btn .= '<p><span class="danger-text">Tolak Perpanjangan</span></p>';
                    $btn .= '<p><a href = "/peminjaman/alat/status/' . $s->id . '/kembali"><button class="btn btn-secondary btn-round btn-sm"><i class="fas fa-exchange-alt"></i>&nbsp;Kembali</button></a></p>';
                } else if ($s->status == "kembali") {
                    $btn = '<span class="secondary-text">Kembali</span>';
                }
                return $btn;
            })
            ->addColumn('peminjam', function ($s) {
                $btn = $s->User->nama;
                return $btn;
            })
            ->editColumn('inventory', function ($s) {
                $btn = $s->Inventory->nama_barang;
                return $btn;
            })
            ->editColumn('keterangan', function ($s) {
                $btn = $s->keterangan;
                if (!empty($s->tanggal_batas_pengembalian)) {
                    $due_date = Carbon::parse($s->tanggal_batas_pengembalian);
                    $today_date = Carbon::now();
                    $res =  $today_date->diffInDays($due_date, false);
                    if ($res >= 1 && $res <= 3) {
                        $btn .= '<p><span class="warning-text">Batas Pengembalian ' . $res . ' hari lagi</span></p>';
                    } else if ($res < 1) {
                        $btn .= '<p><span class="danger-text">Waktu telah habis, Silahkan lakukan pengembalian barang</span></p>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['status', 'keterangan'])
            ->make(true);
    }

    public function karyawan_peminjaman()
    {
        return view('page.it.karyawan_peminjaman_show');
    }

    public function karyawan_peminjaman_show()
    {
        $divisi = Auth::user()->Divisi->id;
        $s = Karyawan::has('PeminjamanKaryawan')->where('divisi_id', $divisi)->get();

        echo json_encode($s);
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('karyawan_id', function ($s) {
                return $s->nama;
            })
            ->editColumn('nama_penugasan', function ($s) {
                return $s->peminjaman_karyawan->nama_penugasan;
            })
            ->addColumn('penanggung_jawab', function ($s) {
                // return $s->PeminjamanKaryawan->PenanggungJawab->nama;
            })
            ->editColumn('tanggal_pembuatan', function ($s) {
                if (!empty($s->PeminjamanKaryawan->tanggal_pembuatan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->PeminjamanKaryawan->tanggal_pembuatan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_penugasan', function ($s) {
                if (!empty($s->PeminjamanKaryawan->tanggal_penugasan)) {
                    return Carbon::createFromFormat('Y-m-d', $s->PeminjamanKaryawan->tanggal_penugasan)->format('d/m/Y');
                }
            })
            ->editColumn('tanggal_selesai', function ($s) {
                if (!empty($s->PeminjamanKaryawan->tanggal_selesai)) {
                    return Carbon::createFromFormat('Y-m-d', $s->PeminjamanKaryawan->tanggal_selesai)->format('d/m/Y');
                } else {
                    $btn = '<a href = "/peminjaman/karyawan/status/' . $s->PeminjamanKaryawan->id . '/selesai"><button class="btn btn-success btn-sm m-1"><i class="fas fa-check"></i>&nbsp;Selesai</button></a>';
                    $btn .= '<p><small class="purple-text">Estimasi Selesai: ' . Carbon::createFromFormat('Y-m-d', $s->PeminjamanKaryawan->tanggal_estimasi_selesai)->format('d/m/Y') . '</small></p>';
                    return $btn;
                }
            })
            ->editColumn('keterangan', function ($s) {
                // $btn = $s->Karyawan()->pivot->keterangan;
                $btn = "";
                return $btn;
            })
            ->editColumn('status', function ($s) {
                $btn = "";
                // if ($s->pivot->status == "draft") {
                //     $btn = '<a href = "/peminjaman/karyawan/detail/status/' . $s->id . '/' . $s->Karyawan->id . '/menunggu"><button class="btn btn-info btn-sm m-1"><i class="far fa-paper-plane"></i>&nbsp;Meminta Persetujuan</button></a>';
                // } else if ($s->pivot->status == 'menunggu') {
                //     $btn = '<span class="warning-text">Menunggu</span>';
                // } else if ($s->pivot->status == 'terima') {
                //     $btn = '<span class="warning-text">Diterima</span>';
                // } else if ($s->pivot->status == 'tolak') {
                //     $btn = '<span class="warning-text">Ditolak</span>';
                // } else if ($s->pivot->status == 'berhenti') {
                //     $btn = '<span class="warning-text">Berhenti</span>';
                // }
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/peminjaman/karyawan/detail/' . $s->PeminjamanKaryawan->id . '" data-id="' . $s->PeminjamanKaryawan->id . '"><button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button></a>';
                $btn .= '<a href = "/peminjaman/karyawan/edit/' . $s->PeminjamanKaryawan->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                $btn .= '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-attr="/peminjaman/karyawan/delete/' . $s->PeminjamanKaryawan->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['aksi', 'tanggal_selesai'])
            ->make(true);
    }
}
