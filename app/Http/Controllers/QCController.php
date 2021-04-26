<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bppb;
use App\Karyawan;
use App\Perakitan;
use App\HasilPerakitan;
use App\HistoriHasilPerakitan;
use App\PemeriksaanRakit;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QCController extends Controller
{
    public function perakitan_pemeriksaan()
    {
        return view('page.qc.perakitan_pemeriksaan_show');
    }

    public function perakitan_pemeriksaan_show()
    {
        $p = Bppb::whereHas('Perakitan', function ($q) {
            $q->whereNotIn('status', ['0']);
        })->get();

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
                $btn = '<a class="detailmodal" data-toggle="modal" data-target="#detailmodal" data-attr="/perakitan/pemeriksaan/laporan/show/' . $s->id . '" data-id="' . $s->id . '">';
                $btn .= '<button type="button" class="rounded-pill btn btn-sm btn-info">';
                $btn .= '<span style="color:white;"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Detail Laporan</span></button></a>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href="/perakitan/pemeriksaan/bppb/' . $s->id . '"><button type="button" class="rounded-pill btn btn-sm btn-primary"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Lihat Semua Data</button>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_bppb($id)
    {
        $s = Bppb::find($id);
        return view('page.qc.perakitan_pemeriksaan_bppb_show', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_bppb_show($id)
    {
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($id) {
            $q->where('bppb_id', '=', $id);
        })->whereNotIn('status', ['dibuat'])->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->editColumn('kondisi_fisik_bahan_baku', function ($s) {
                $btn = "";
                if ($s->kondisi_fisik_bahan_baku == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_fisik_bahan_baku == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('kondisi_saat_proses_perakitan', function ($s) {
                $btn = "";
                if ($s->kondisi_saat_proses_perakitan == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_saat_proses_perakitan == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_terbuka', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_terbuka != "ok" && !empty($s->tindak_lanjut_terbuka)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i>&nbsp;';
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_terbuka);
                    }
                    $btn .= '</small><div><small>' . $s->keterangan_tindak_lanjut_terbuka . '</small></div>';
                }
                return $btn;
            })
            ->editColumn('kondisi_setelah_proses', function ($s) {
                $btn = "";
                if ($s->kondisi_setelah_proses == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->kondisi_setelah_proses == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('hasil', function ($s) {
                $btn = "";
                if ($s->hasil == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('fungsi', function ($s) {
                $btn = "";
                if ($s->fungsi == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->fungsi == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_tertutup', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_tertutup == "aging") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_tertutup != "aging" && !empty($s->tindak_lanjut_tertutup)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i>&nbsp;<b>';
                    if ($s->tindak_lanjut_tertutup == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_tertutup);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_tertutup . '</small></div>';
                }
                return $btn;
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Perakitan->Karyawan as $i) {
                    array_push($arr, $i->nama);
                }
                return implode("<br>", $arr);
            })
            ->addColumn('aksi', function ($s) {
                // $btn = '<a href="/perakitan/pemeriksaan/edit_pemeriksaan_terbuka/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                // return $btn;
                $btn = "";
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/pemeriksaan/terbuka/edit/' . $s->id . '"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Pemeriksaan Terbuka</button></a>';
                } else if ($s->status == "acc_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "rej_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<a href="/perakitan/pemeriksaan/tertutup/edit/' . $s->id . '"><button class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>&nbsp;Pemeriksaan Tertutup</button></a>';
                } else if ($s->status == "acc_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                } else if ($s->status == "rej_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                }
                return $btn;
            })
            // ->editColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == "req_pemeriksaan_terbuka") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Terbuka</span>';
            //     } else if ($s->status == "acc_pemeriksaan_terbuka") {
            //         $btn = '<span class="warning-text">Menunggu Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "rej_pemeriksaan_terbuka") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     } else if ($s->status == "req_pemeriksaan_tertutup") {
            //         $btn = '<span class="info-text">Permintaan Pemeriksaan Tertutup</span>';
            //     } else if ($s->status == "acc_pemeriksaan_tertutup") {
            //         $btn = '<span class="warning-text">Selesai Pemeriksaan Perakitan</span>';
            //     } else if ($s->status == "rej_pemeriksaan_tertutup") {
            //         $btn = '<span class="danger-text">Pemeriksaan Terbuka Not OK</span>';
            //     }
            //     return $btn;
            // })
            ->rawColumns(['operator', 'aksi', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'kondisi_setelah_proses', 'hasil', 'fungsi', 'tindak_lanjut_tertutup'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_laporan()
    {
        return view('page.qc.perakitan_pemeriksaan_laporan_show');
    }

    public function perakitan_pemeriksaan_laporan_show($id)
    {
        $s = Perakitan::whereHas('Bppb', function ($query) use ($id) {
            $query->where('id', '=', $id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                $arr = [];
                foreach ($s->Karyawan as $i) {
                    array_push($arr, $i->nama);
                }
                return implode("<br>", $arr);
            })
            ->addColumn('jumlah', function ($s) {
                $btn = HasilPerakitan::where('perakitan_id', $s->id)->count();
                return $btn . " " . $s->Bppb->DetailProduk->satuan;
            })
            // ->addColumn('status', function ($s) {
            //     $btn = "";
            //     if ($s->status == '12') {
            //         $c = HasilPerakitan::where('perakitan_id', '=', $s->id)->whereIn('status', ['req_pemeriksaan_terbuka', 'req_pemeriksaan_tertutup'])->count();
            //         if ($c > 0) {
            //             $btn = '<span class="warning-text">
            //             Periksa
            //         </span>';
            //         } else if ($c <= 0) {
            //             $btn = '<div class="inline-flex">
            //             <a href = "/perakitan/laporan/status/' . $s->id . '/selesai">
            //                 <button type="button" class="btn btn-block btn-outline-success karyawan-img-small" style="border-radius:50%;" title="Kirim Laporan ke Produksi"><i class="fas fa-check"></i></button>
            //             </a>
            //             </div>';
            //         }
            //     }

            //     return $btn;
            // })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/perakitan/pemeriksaan/hasil/' . $s->id . '"><button class="btn btn-info circle-button btn-circle-sm m-1 karyawan-img-small"><i class="fas fa-eye"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['operator', 'aksi'])
            ->make(true);
    }

    public function perakitan_pemeriksaan_terbuka_edit($id)
    {
        $s = HasilPerakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_terbuka_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_terbuka_update($id, Request $request)
    {
        $status = "";
        if ($request->tindak_lanjut_terbuka == "ok") {
            $status = "acc_pemeriksaan_terbuka";
        } else {
            $status = "rej_pemeriksaan_terbuka";
        }

        $h = HasilPerakitan::find($id);
        $h->kondisi_fisik_bahan_baku = $request->kondisi_fisik_bahan_baku;
        $h->kondisi_saat_proses_perakitan = $request->kondisi_saat_proses_perakitan;
        $h->tindak_lanjut_terbuka = $request->tindak_lanjut_terbuka;
        $h->hasil_terbuka = $request->hasil_terbuka;
        $h->keterangan_tindak_lanjut_terbuka = $request->keterangan_tindak_lanjut_terbuka;
        $h->status = $status;
        $u = $h->save();


        if ($u) {
            $c = HistoriHasilPerakitan::create([
                'hasil_perakitan_id' => $id,
                'kegiatan' => 'pemeriksaan_terbuka',
                'tanggal' => Carbon::now()->toDateString(),
                'hasil' => $request->hasil_terbuka,
                'keterangan' => $request->keterangan_tindak_lanjut_terbuka,
                'tindak_lanjut' => $request->tindak_lanjut_terbuka
            ]);
            if ($c) {
                return redirect()->back()->with('success', "Berhasil mengubah Data");
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        } else {
            return redirect()->back()->with('error', "Gagal mengubah Data");
        }
    }

    public function perakitan_pemeriksaan_tertutup_edit($id)
    {
        $s = HasilPerakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_tertutup_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_tertutup_update($id, Request $request)
    {
        $status = "";
        if ($request->tindak_lanjut_tertutup == "ok") {
            $status = "acc_pemeriksaan_tertutup";
        } else {
            $status = "rej_pemeriksaan_tertutup";
        }

        $h = HasilPerakitan::find($id);
        $h->fungsi = $request->fungsi;
        $h->kondisi_setelah_proses = $request->kondisi_setelah_proses;
        $h->hasil_tertutup = $request->hasil_tertutup;
        $h->tindak_lanjut_tertutup = $request->tindak_lanjut_tertutup;
        $h->keterangan_tindak_lanjut_tertutup = $request->keterangan_tindak_lanjut_tertutup;
        $h->status = $status;
        $u = $h->save();

        if ($u) {
            $c = HistoriHasilPerakitan::create([
                'hasil_perakitan_id' => $id,
                'kegiatan' => 'pemeriksaan_tertutup',
                'tanggal' => Carbon::now()->toDateString(),
                'hasil' => $request->hasil_tertutup,
                'keterangan' => $request->keterangan_tindak_lanjut_tertutup,
                'tindak_lanjut' => $request->tindak_lanjut_terbuka
            ]);
            if ($c) {
                return redirect()->back()->with('success', "Berhasil mengubah Data");
            } else {
                return redirect()->back()->with('error', "Gagal mengubah Data");
            }
        } else {
            return redirect()->back()->with('error', "Gagal mengubah Data");
        }
    }

    public function perakitan_pemeriksaan_laporan_edit($id)
    {
        $s = Perakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_laporan_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_laporan_update($id, Request $request)
    {
        $bool = true;
        for ($i = 0; $i < count($request->id); $i++) {
            $status = "";
            if ($request->kondisi_terbuka[$i] == "ok") {
                $status = "acc_pemeriksaan_terbuka";
            } else if ($request->kondisi_terbuka[$i] == "nok") {
                $status = "rej_pemeriksaan_terbuka";
            }
            $h = HasilPerakitan::find($request->id[$i]);
            $h->kondisi_terbuka = $request->kondisi_terbuka[$i];
            $h->tindak_lanjut_terbuka = $request->tindak_lanjut_terbuka[$i];
            $h->status = $status;
            $u = $h->save();


            HistoriHasilPerakitan::create([
                'hasil_perakitan_id' => $request->id[$i],
                'kegiatan' => 'pemeriksaan_terbuka',
                'tanggal' => Carbon::now()->toDateString(),
                'hasil' => $request->kondisi_terbuka[$i],
                'keterangan' => $request->keterangan[$i],
                'tindak_lanjut' => $request->tindak_lanjut_terbuka[$i]
            ]);
            if (!$u) {
                $bool = false;
            }
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah Data");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal mengubah Data");
        }
    }

    public function perakitan_pemeriksaan_hasil($id)
    {
        $s = Perakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_hasil_show', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_hasil_show($id)
    {
        $s = HasilPerakitan::where('perakitan_id', '=', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('aksi', function ($s) {
                if ($s->status == 'req_pemeriksaan_terbuka' || $s->status == 'req_pemeriksaan_tertutup') {
                    $btn = '<div class="inline-flex">
                    <a href = "/perakitan/pemeriksaan/hasil/' . $s->id . '">
                    <button class="btn btn-primary circle-button btn-circle-sm m-1" style="border-radius:50%;"><i class="fas fa-tasks"></i></button></a>
                    </div>';
                } else {
                    $btn = '<button class="btn btn-secondary circle-button btn-circle-sm m-1 karyawan-img-small" disabled><i class="fas fa-tasks"></i></button>';
                }
                return $btn;
            })
            ->rawColumns(['operator', 'aksi'])
            ->make(true);
    }

    public function tambah_pemeriksaan_rakit($id)
    {
        // $p = Perakitan::find($id);
        // $k = Karyawan::all();
        // return view('ui.perakitan.pemeriksaan_rakit.create', ['p' => $p, 'k' => $k]);
    }

    public function store_pemeriksaan_rakit($id, Request $request)
    {
        // $cpr = PemeriksaanRakit::create([
        //     'perakitan_id' => $id,
        //     'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
        //     'keterangan' => $request->keterangan,
        //     'kesimpulan' => $request->kesimpulan,
        //     'status' => $request->status
        // ]);

        // $chpr = HasilPemeriksaanRakit::create([
        //     'pemeriksaan_rakit_id' => $cpr->id,
        //     'hasil_perakitan_id' => $request->no_seri,
        //     'kondisi' => $request->kondisi,
        //     'tindak_lanjut' => $request->tindak_lanjut,
        //     'keterangan' => $request->keterangan
        // ]);

        // return redirect()->back()->with();
    }
}
