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
use Carbon\Carbon;
use App\Http\Controllers\GetController;
use App\Http\Controllers\UserLogController;
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
    //PRODUK
    public function produk()
    {
        $s = Produk::all();
        return view('page.it.produk_show', ['s' => $s]);
    }

    public function tambah_produk()
    {
        $k = KelompokProduk::all();
        return view('page.it.produk_create', ['k' => $k]);
    }

    public function store_produk(Request $request)
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
                'foto' => NULL,
                'kode' => $request->kode,
                'kode_barcode' => $request->kode_barcode,
                'berat' => $request->berat,
                'satuan' => $request->satuan,
                'nama_coo' => $request->nama_coo,
                'no_akd' => $request->no_akd,
                'keterangan' => $request->keterangan
            ]);
            if ($c) {
                $this->UserLogController->create(Auth::user()->id, $request->tipe, 'Produk', 'Tambah', "");
                return redirect()->back()->with('success', "Berhasil menambahkan Produk");
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Produk");
            }
        }
    }

    public function edit_produk($id)
    {
        $k = KelompokProduk::all();
        $kp = KategoriProduk::all();
        $p = Produk::find($id);
        return view('page.it.produk_edit', ['k' => $k, 'kp' => $kp, 'i' => $p]);
    }

    public function update_produk($id, Request $request)
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

    public function delete_produk($id, Request $request)
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

    public function inventory($divisi_id)
    {
        return view('page.it.inventory_show', ['divisi_id' => $divisi_id]);
    }

    public function inventory_show($divisi_id)
    {
        $s = Inventory::whereHas('DivisiInventory', function ($q)  use ($divisi_id) {
            $q->where('divisi_id', $divisi_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal_perolehan', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal_perolehan)->format('d/m/Y');
            })
            ->editColumn('status', function ($s) {
                return ucfirst($s->status);
            })
            ->editColumn('harga_perolehan', function ($s) {
                return 'Rp. ' . number_format($s->harga_perolehan);
            })
            ->addColumn('nilai_penyusutan', function ($s) {
                // return round($this->GetController->inventory_nilai_penyusutan($s->harga_perolehan, $s->jumlah, $s->masa_manfaat));
                return 'Rp. ' . number_format(round($s->nilai_penyusutan()));
            })
            ->addColumn('akum_nilai_penyusutan', function ($s) {
                // return round($this->GetController->inventory_akum_nilai_penyusutan($s->harga_perolehan, $s->jumlah, $s->masa_manfaat, $s->tanggal_perolehan));
                return 'Rp. ' . number_format(round($s->akum_nilai_penyusutan()));
            })
            ->addColumn('nilai_sisa_buku', function ($s) {
                // return round($this->GetController->inventory_nilai_sisa_buku($s->harga_perolehan, $s->jumlah, $s->masa_manfaat, $s->tanggal_perolehan));
                $btn = 'Rp. ' . number_format(round($s->nilai_sisa_buku()));
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btnedit = '<a href = "/inventory/edit/' . $s->id . '"><button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button></a>';
                $btndelete = '<a class="deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="/inventory/delete/' . $s->id . '"><button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-trash"></i></button></a>';
                $btnaksi = $btnedit . $btndelete;
                return $btnaksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function inventory_delete($id,  Request $request)
    {
        $p = Inventory::find($id);
        $this->UserLogController->create(Auth::user()->id, $p->kode_barang . " " . $p->nama_barang, 'Inventory', 'Hapus', $request->keterangan_log);
        $p->delete();
        return redirect()->back();
    }
}
