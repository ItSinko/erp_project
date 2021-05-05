<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailProduk;
use App\Bppb;
use App\Karyawan;
use App\Perakitan;
use App\HasilPerakitan;
use App\HistoriHasilPerakitan;
use App\MonitoringProses;
use App\HasilMonitoringProses;
use App\PemeriksaanRakit;
use App\IkPemeriksaanPengujian;
use App\HasilIkPemeriksaanPengujian;
use App\PemeriksaanProsesPengujian;
use App\HasilPemeriksaanProsesPengujian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class QCController extends Controller
{
    public function perakitan_pemeriksaan()
    {
        return view('page.qc.perakitan_pemeriksaan_show');
    }

    public function perakitan_pemeriksaan_show()
    {
        $p = Bppb::with('Perakitan')->get();

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
            ->editColumn('hasil_terbuka', function ($s) {
                $btn = "";
                if ($s->hasil_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_terbuka == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_terbuka', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_terbuka != "ok" && !empty($s->tindak_lanjut_terbuka)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><b>&nbsp;';
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_terbuka);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_terbuka . '</small></div>';
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
            ->editColumn('hasil_tertutup', function ($s) {
                $btn = "";
                if ($s->hasil_tertutup == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_tertutup == "nok") {
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
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/pemeriksaan/terbuka/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Pemeriksaan Terbuka</small></div></a>';
                } else if ($s->status == "acc_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "rej_pemeriksaan_terbuka" || $s->status == "perbaikan_pemeriksaan_terbuka" || $s->status == "analisa_pemeriksaan_terbuka_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<a href="/perakitan/pemeriksaan/tertutup/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Pemeriksaan Tertutup</small></div></a>';
                } else if ($s->status == "acc_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                } else if ($s->status == "rej_pemeriksaan_tertutup" || $s->status == "perbaikan_pemeriksaan_tertutup" || $s->status == "analisa_pemeriksaan_tertutup_ps") {
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
            ->rawColumns(['operator', 'aksi', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'kondisi_setelah_proses', 'hasil_terbuka', 'hasil_tertutup', 'fungsi', 'tindak_lanjut_tertutup'])
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
        $v = [];
        if ($request->hasil_terbuka == "ok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_terbuka' => 'required',
                ],
                [
                    'tindak_lanjut_terbuka.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->hasil_terbuka == "nok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_terbuka' => 'required',
                    'keterangan_tindak_lanjut_terbuka' => 'required',
                ],
                [
                    'tindak_lanjut_terbuka.required' => "Tindak Lanjut harus dipilih",
                    'keterangan_tindak_lanjut_terbuka.required' => "Keterangan harus diisi",
                ]
            );
        }
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $status = "";
            if ($request->hasil_terbuka == "ok") {
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
    }

    public function perakitan_pemeriksaan_tertutup_edit($id)
    {
        $s = HasilPerakitan::find($id);
        return view('page.qc.perakitan_pemeriksaan_tertutup_edit', ['id' => $id, 's' => $s]);
    }

    public function perakitan_pemeriksaan_tertutup_update($id, Request $request)
    {
        $v = [];
        if ($request->hasil_tertutup == "ok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_tertutup' => 'required',
                ],
                [
                    'tindak_lanjut_tertutup.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->hasil_tertutup == "nok") {
            $v = Validator::make(
                $request->all(),
                [
                    'tindak_lanjut_tertutup' => 'required',
                    'keterangan_tindak_lanjut_tertutup' => 'required',
                ],
                [
                    'tindak_lanjut_tertutup.required' => "Tindak Lanjut harus dipilih",
                    'keterangan_tindak_lanjut_tertutup.required' => "Keterangan harus diisi",
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $status = "";
            if ($request->hasil_tertutup == "ok") {
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
                    'tindak_lanjut' => $request->tindak_lanjut_tertutup
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
            ->editColumn('hasil_terbuka', function ($s) {
                $btn = "";
                if ($s->hasil_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_terbuka == "nok") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i></small>';
                }
                return $btn;
            })
            ->editColumn('tindak_lanjut_terbuka', function ($s) {
                $btn = "";
                if ($s->tindak_lanjut_terbuka == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->tindak_lanjut_terbuka != "ok" && !empty($s->tindak_lanjut_terbuka)) {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><b>&nbsp;';
                    if ($s->tindak_lanjut_terbuka == "produk_spesialis") {
                        $btn .= 'Produk Spesialis';
                    } else {
                        $btn .= ucfirst($s->tindak_lanjut_terbuka);
                    }
                    $btn .= '</b></small><div><small>' . $s->keterangan_tindak_lanjut_terbuka . '</small></div>';
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
            ->editColumn('hasil_tertutup', function ($s) {
                $btn = "";
                if ($s->hasil_tertutup == "ok") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i></small>';
                } else if ($s->hasil_tertutup == "nok") {
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
                    array_push($arr, "<small>" . $i->nama . "</small>");
                }
                return implode("<br>", $arr);
            })
            ->addColumn('aksi', function ($s) {
                $btn = "";
                if ($s->status == "req_pemeriksaan_terbuka") {
                    $btn = '<a href="/perakitan/pemeriksaan/terbuka/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                                <div><small>Pemeriksaan Terbuka</small></div></a>';
                } else if ($s->status == "acc_pemeriksaan_terbuka") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "rej_pemeriksaan_terbuka" || $s->status == "perbaikan_pemeriksaan_terbuka" || $s->status == "analisa_pemeriksaan_terbuka_ps") {
                    $btn = '<small><i style="color:red;" class="fas fa-times-circle"></i><div>Pemeriksaan Terbuka</div></small>';
                } else if ($s->status == "req_pemeriksaan_tertutup") {
                    $btn = '<a href="/perakitan/pemeriksaan/tertutup/edit/' . $s->id . '"><button type="button" class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-wrench"></i></button>
                            <div><small>Pemeriksaan Tertutup</small></div></a>';
                } else if ($s->status == "acc_pemeriksaan_tertutup") {
                    $btn = '<small><i style="color:green;" class="fas fa-check-circle"></i><div>Pemeriksaan Tertutup</div></small>';
                } else if ($s->status == "rej_pemeriksaan_tertutup" || $s->status == "perbaikan_pemeriksaan_tertutup" || $s->status == "analisa_pemeriksaan_tertutup_ps") {
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
            ->rawColumns(['operator', 'aksi', 'kondisi_fisik_bahan_baku', 'kondisi_saat_proses_perakitan', 'tindak_lanjut_terbuka', 'kondisi_setelah_proses', 'hasil_terbuka', 'hasil_tertutup', 'fungsi', 'tindak_lanjut_tertutup'])
            ->make(true);
    }

    public function perakitan_ik_pemeriksaan()
    {
        return view('page.qc.perakitan_ik_pemeriksaan');
    }

    public function pengujian()
    {
        return view('page.qc.pengujian_show');
    }

    public function pengujian_show()
    {
        $s = Bppb::with('Perakitan')->whereHas('Perakitan.HasilPerakitan', function ($q) {
            $q->whereIn('status', ['acc_pemeriksaan_tertutup']);
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
                        <div class="subheading "><small class="purple-text">Produksi saat ini: ' . $s->countHasilPerakitan() . ' ' . $s->DetailProduk->satuan . '</small></div>
                        <div class="subheading "><small class="info-text">Dapat Diuji: ' . $count . ' ' . $s->DetailProduk->satuan . '</small></div>
                        </hgroup>';
                return $btn;
            })
            ->addColumn('laporan', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat laporan"><i class="fas fa-ellipsis-h"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">';
                $btn .= '<a class="dropdown-item monitoringprosesmodal" data-toggle="modal" data-target="#monitoringprosesmodal" data-attr="/pengujian/monitoring_proses/show/' . $s->id . '" data-id="' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Monitoring Proses</span></a>';
                $btn .= '<a class="dropdown-item" href="/pengujian/pemeriksaan_proses/hasil/' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;Pemeriksaan Proses</span></a>';
                $btn .= '<a class="dropdown-item luplkpmodal" data-toggle="modal" data-target="#luplkpmodal" data-attr="/produk/detail/show/' . $s->id . '" data-id="' . $s->id . '"><span style="color: black;"><i class="fas fa-eye" aria-hidden="true"></i>&nbsp;LUP dan LKP</span></a>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat laporan"><i class="fas fa-plus-circle" aria-hidden="true"></i></a>';
                $btn .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">';
                $btn .= '<a class="dropdown-item" href="/pengujian/monitoring_proses/create/' . $s->id . '"><span style="color: black;"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Monitoring Proses</span></a>';
                $btn .= '<a class="dropdown-item" href="/pengujian/pemeriksaan_proses/create/' . $s->id . '"><span style="color: black;"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;Pemeriksaan Proses</span></a>';
                $btn .= '<a class="dropdown-item luplkpmodal" data-toggle="modal" data-target="#luplkpmodal" data-attr="/produk/detail/show/' . $s->id . '" data-id="' . $s->id . '"><span style="color: black;"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;LUP dan LKP</span></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'jumlah', 'laporan', 'aksi'])
            ->make(true);
    }

    public function pengujian_monitoring_proses()
    {
        return view('page.qc.pengujian_monitoring_proses_show');
    }

    public function pengujian_monitoring_proses_show($bppb_id)
    {
        $s = MonitoringProses::whereHas('Bppb', function ($q) use ($bppb_id) {
            $q->where('id', $bppb_id);
        })->get();

        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('operator', function ($s) {
                return $s->Karyawan->nama;
            })
            ->addColumn('jumlah', function ($s) {
                $countok = HasilMonitoringProses::where([
                    ['monitoring_proses_id', '=', $s->id],
                    ['hasil', '=', 'ok']
                ])->count();

                $countnok = HasilMonitoringProses::where([
                    ['monitoring_proses_id', '=', $s->id],
                    ['hasil', '=', 'nok']
                ])->count();
                $btn = '<div class="success-text"><small>Hasil Baik: </small><b>' . $countok . '</b></div><div class="danger-text"><small>Hasil Tidak Baik: </small><b>' . $countnok . '</b></div>';
                return $btn;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/pengujian/monitoring_proses/hasil/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                        <a href = "/pengujian/monitoring_proses/laporan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['operator', 'jumlah', 'aksi'])
            ->make(true);
    }

    public function pengujian_monitoring_proses_hasil($id)
    {
        $s = MonitoringProses::find($id);
        return view('page.qc.pengujian_monitoring_proses_hasil_show', ['id' => $id, 's' => $s]);
    }

    public function pengujian_monitoring_proses_hasil_show($id)
    {
        $s = HasilMonitoringProses::where('monitoring_proses_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->addColumn('no_seri', function ($s) {
                return $s->HasilPerakitan->no_seri;
            })
            ->editColumn('no_barcode', function ($s) {
                $b = "";
                if ($s->no_barcode == "") {
                    $b = '<span class="text-muted">Tidak Tersedia</span>';
                } else {
                    $b = $s->no_barcode;
                }
                return $b;
            })
            ->editColumn('hasil', function ($s) {
                $b = "";
                if ($s->hasil == "ok") {
                    $b = '<i class="fas fa-check-circle" style="color:green;"></i>';
                } else if ($s->hasil == "nok") {
                    $b = '<i class="fas fa-times-circle" style="color:red;"></i>';
                }
                return $b;
            })
            ->editColumn('tindak_lanjut', function ($s) {
                $b = "";
                if ($s->tindak_lanjut == 'pengemasan') {
                    $b .= '<i class="fas fa-check-circle" style="color:green;"></i><br>';
                } else {
                    $b .= '<i class="fas fa-times-circle" style="color:red;"></i><br>';
                }
                $b .= ucfirst($s->tindak_lanjut);
                return $b;
            })
            ->addColumn('aksi', function ($s) {
                $btn = '<a href = "/pengujian/monitoring_proses/laporan/edit' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengujian/monitoring_proses/laporan/delete' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['no_barcode', 'hasil', 'tindak_lanjut', 'aksi'])
            ->make(true);
    }

    public function pengujian_monitoring_proses_create($bppb_id)
    {
        $b = Bppb::find($bppb_id);
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })->whereDoesntHave('HasilMonitoringProses', function ($q) {
            $q->where('hasil', 'ok');
        })->whereIn('status', ['acc_pemeriksaan_tertutup'])->get();
        $k = Karyawan::whereNotIn('jabatan', ['direktur', 'manager'])->get();
        $p = IkPemeriksaanPengujian::where('detail_produk_id', '=', $b->detail_produk_id)->get();
        return view('page.qc.pengujian_monitoring_proses_create', ['bppb_id' => $bppb_id, 'kry' => $k, 's' => $s, 'b' => $b, 'p' => $p]);
    }

    public function pengujian_monitoring_proses_store(Request $request, $bppb_id)
    {
        $v = [];
        echo ($request->brc);
        if ($request->brc == "tidak") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->brc == "ya") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                    'no_barcode.*' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                    'no_barcode.*.required' => "No Barcode harus diisi",
                ]
            );
        }

        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = MonitoringProses::create([
                'bppb_id' => $bppb_id,
                'tanggal' => $request->tanggal_laporan,
                'karyawan_id' => $request->karyawan_id,
                'user_id' => Auth::user()->id
            ]);


            if ($c) {
                if (!empty($request->no_seri)) {
                    $bool = true;
                    for ($i = 0; $i < count($request->no_seri); $i++) {

                        $cs = HasilMonitoringProses::create([
                            'monitoring_proses_id' => $c->id,
                            'hasil_perakitan_id' => $request->no_seri[$i],
                            'no_barcode' => $request->no_barcode[$i],
                            'hasil' => $request->hasil[$i],
                            'keterangan' => $request->keterangan[$i],
                            'tindak_lanjut' => $request->tindak_lanjut[$i]
                        ]);

                        if ($cs) {
                            $u = HasilMonitoringProses::find($cs->id);
                            $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan[$i]);
                            $up = $u->save();

                            if (!$up) {
                                $bool = false;
                            }
                        }
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Produk");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Produk");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Produk");
            }
        }
    }

    public function pengujian_monitoring_proses_laporan_edit($id)
    {
        $s = MonitoringProses::find($id);
        $bppb_id = $s->bppb_id;
        $kry = Karyawan::whereNotIn('jabatan', ['direktur', 'manager', 'asisten manager'])->get();
        $p = IkPemeriksaanPengujian::where('detail_produk_id', '=', $s->Bppb->detail_produk_id)->get();
        $ns = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb_id) {
            $q->where('bppb_id', $bppb_id);
        })
            ->whereIn('status', ['acc_pemeriksaan_tertutup'])
            ->DoesntHave('HasilMonitoringProses')
            ->orWhereHas('HasilMonitoringProses', function ($q) use ($id) {
                $q->where('monitoring_proses_id', $id);
            })->get();

        return view('page.qc.pengujian_monitoring_proses_laporan_edit', ['id' => $id, 's' => $s, 'kry' => $kry, 'ns' => $ns, 'p' => $p]);
    }

    public function pengujian_monitoring_proses_laporan_update($id, Request $request)
    {
        $v = [];
        if ($request->brc == "tidak") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.*.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                ]
            );
        } else if ($request->brc == "ya") {
            $v = Validator::make(
                $request->all(),
                [
                    'tanggal_laporan' => 'required',
                    'karyawan_id' => 'required',
                    'no_seri' => 'required',
                    'tindak_lanjut' => 'required',
                    'no_barcode.*' => 'required',
                ],
                [
                    'tanggal_laporan.required' => "Tanggal harus diisi",
                    'no_seri.required' => "No Seri harus diisi",
                    'karyawan_id.required' => "Karyawan harus dipilih",
                    'tindak_lanjut.required' => "Tindak Lanjut harus dipilih",
                    'no_barcode.*.required' => "No Barcode harus diisi",
                ]
            );
        }
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $s = MonitoringProses::find($id);
            $s->tanggal = $request->tanggal_laporan;
            $s->karyawan_id = $request->karyawan_id;
            $s->save();
            if ($s) {
                $hpid = array();
                if (!empty($request->hasil)) {
                    $bool = true;
                    $v = 0;
                    for ($i = 0; $i < count($request->hasil); $i++) {
                        echo ('id' . $request->mpid[$i]);
                        if (!empty($request->mpid[$i])) {
                            $hpid[$v] = $request->mpid[$i];
                            echo json_encode($hpid);
                            $u = HasilMonitoringProses::find($request->mpid[$i]);
                            $u->hasil_perakitan_id = $request->no_seri[$i];
                            $u->no_barcode = $request->no_barcode[$i];
                            $u->hasil = $request->hasil[$i];
                            $u->tindak_lanjut = $request->tindak_lanjut[$i];
                            $u->keterangan = $request->keterangan[$i];
                            $u->HasilIkPemeriksaanPengujian()->sync($request->pemeriksaan[$i]);
                            $us = $u->save();

                            if (!$us) {
                                $bool = false;
                            }
                        } else if (empty($request->id[$i])) {

                            $cs  = HasilMonitoringProses::create([
                                'monitoring_proses_id' => $id,
                                'hasil_perakitan_id' => $request->no_seri[$i],
                                'no_barcode' => $request->no_barcode[$i],
                                'hasil' => $request->hasil[$i],
                                'keterangan' => $request->keterangan[$i],
                                'tindak_lanjut' => $request->tindak_lanjut[$i]
                            ]);
                            if (!$cs) {
                                $bool = false;
                            } else if ($cs) {
                                $hpid[$v] = $cs->id;
                            }
                        }
                        $v++;
                    }
                    echo json_encode($hpid);
                    if (!empty($hpid)) {
                        HasilMonitoringProses::where('monitoring_proses_id', $id)->whereNotIn('id', $hpid)->delete();
                    }
                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Pengujian");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
            }
        }
    }

    public function pengujian_monitoring_proses_hasil_delete($id, Request $request)
    {
        $p = HasilMonitoringProses::where('id', $id)->first();
        $this->UserLogController->create(Auth::user()->id, "Hasil Monitoring Proses " . $p->HasilPerakitan->no_seri . ", untuk BPPB " . $p->MonitoringProses->Bppb->no_bppb, 'Hasil Monitoring Proses', 'Hapus', $request->keterangan_log);

        $hp = HasilMonitoringProses::find($id);
        $hp->delete();

        return redirect()->back();
    }

    public function pengujian_pemeriksaan_proses()
    {
        return view('page.qc.pengujian_pemeriksaan_proses_show');
    }

    public function pengujian_pemeriksaan_proses_show($id)
    {
        $s = PemeriksaanProsesPengujian::where('bppb_id', $id)->get();
        return DataTables::of($s)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($s) {
                return Carbon::createFromFormat('Y-m-d', $s->tanggal)->format('d-m-Y');
            })
            ->addColumn('aksi', function ($s) use ($id) {
                $btn = '<a href = "/pengujian/pemeriksaan_proses/hasil/' . $id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/pengujian/pemeriksaan_proses/hasil/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengujian/pemeriksaan_proses/hasil/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pengujian_pemeriksaan_proses_hasil($id)
    {
        $s = Bppb::find($id);
        $p = IkPemeriksaanPengujian::where('detail_produk_id', $id)->get();

        return view('page.qc.pengujian_pemeriksaan_proses_hasil', ['id' => $id, 's' => $s, 'p' => $p]);
    }

    public function pengujian_pemeriksaan_proses_create($id)
    {
        $b = Bppb::find($id);
        $bppbid = $b->DetailProduk->id;
        $s = IkPemeriksaanPengujian::where('detail_produk_id', $bppbid)->get();

        return view('page.qc.pengujian_pemeriksaan_proses_create', ['id' => $id, 's' => $s, 'b' => $b]);
    }

    public function pengujian_pemeriksaan_proses_store($id, Request $request)
    {
        $v = Validator::make(
            $request->all(),
            [
                'no_pemeriksaan' => 'required',
                'tanggal' => 'required',
                'jumlah_produksi' => 'required',
                'jumlah_sampling' => 'required',
            ],
            [
                'no_pemeriksaan.required' => "No Pemeriksaan harus diisi",
                'tanggal.required' => "Tanggal harus diisi",
                'jumlah_produksi.required' => "Jumlah Produksi harus diisi",
                'jumlah_sampling.required' => "Jumlah Sampling harus diisi",
            ]
        );
        if ($v->fails()) {
            return redirect()->back()->withErrors($v);
        } else {
            $c = PemeriksaanProsesPengujian::create([
                'bppb_id' => $id,
                'no_pemeriksaan' => $request->no_pemeriksaan,
                'tanggal' => $request->tanggal,
                'jumlah_produksi' => $request->jumlah_produksi,
                'jumlah_sampling' => $request->jumlah_sampling
            ]);
            if ($c) {
                if (!empty($request->hasil_ik_id)) {
                    $bool = true;
                    for ($j = 0; $j < count($request->hasil_ik_id); $j++) {
                        $cs = HasilPemeriksaanProsesPengujian::create([
                            'pemeriksaan_id' => $c->id,
                            'hasil_ik_id' => $request->hasil_ik_id[$j],
                            'hasil_ok' => $request->hasil_ok[$j],
                            'hasil_nok' => $request->hasil_nok[$j],
                            'karantina' => $request->karantina[$j],
                            'perbaikan' => $request->perbaikan[$j],
                            'keterangan' => $request->keterangan[$j]
                        ]);

                        if (!$cs) {
                            $bool = false;
                        }
                    }

                    if ($bool == true) {
                        return redirect()->back()->with('success', "Berhasil menambahkan Pemeriksaan Proses");
                    } else if ($bool == false) {
                        return redirect()->back()->with('error', "Gagal menambahkan Pemeriksaan Proses");
                    }
                }
            } else {
                return redirect()->back()->with('error', "Gagal menambahkan Pemeriksaan Proses");
            }
        }
    }

    public function pengujian_pemeriksaan_proses_not_ok()
    {
        return view('page.qc.pengujian_pemeriksaan_proses_not_ok');
    }

    public function pengujian_pemeriksaan_proses_not_ok_show($bppb_id, $ik_pengujian_id)
    {
        $s = MonitoringProses::with('HasilMonitoringProses')->whereHas('HasilMonitoringProses.HasilIkPemeriksaanPengujian', function ($q) use ($ik_pengujian_id) {
            $q->where('id', $ik_pengujian_id);
        })->where('bppb_id', $bppb_id)->get();

        return DataTables::of($s->HasilMonitoringProses)
            ->addIndexColumn()
            ->editColumn('hasil_perakitan_id', function ($s) {
                return $s->HasilPerakitan->no_seri;
            })
            ->make(true);
    }

    public function pengujian_pemeriksaan_proses_edit($id)
    {
        return view('page.qc.pengujian_pemeriksaan_proses_edit', ['id' => $id]);
    }

    public function pengujian_pemeriksaan_proses_update($id, Request $request)
    {
        $bool = true;
        for ($j = 0; $j < count($request->hasil_ik_id); $j++) {
            $u = HasilPemeriksaanProsesPengujian::find($request->id[$j]);
            $u->hasil_ok = $request->hasil_ok[$j];
            $u->hasil_nok = $request->hasil_nok[$j];
            $u->karantina = $request->karantina[$j];
            $u->perbaikan = $request->perbaikan[$j];
            $u->keterangan = $request->keterangan[$j];
            $us = $u->save();

            if (!$us) {
                $bool = false;
            }
        }

        if ($bool == true) {
            return redirect()->back()->with('success', "Berhasil mengubah Pemeriksaan Proses");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal mengubah Pemeriksaan Proses");
        }
    }

    public function pengujian_ik_pemeriksaan()
    {
        return view('page.qc.pengujian_ik_pemeriksaan_show');
    }

    public function pengujian_ik_pemeriksaan_show()
    {
        $s = DetailProduk::has('IkPemeriksaanPengujian')->with('Produk')->get();

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
                $btn = '<a href = "/pengujian/ik_pemeriksaan/detail/' . $s->id . '"><button class="btn btn-info btn-sm m-1" style="border-radius:50%;"><i class="fas fa-eye"></i></button></a>
                <a href = "/pengujian/ik_pemeriksaan/edit/' . $s->id . '"><button class="btn btn-warning btn-sm m-1" style="border-radius:50%;"><i class="fas fa-pencil-alt"></i></button></a>
                <a href = "/pengujian/ik_pemeriksaan/delete/' . $s->id . '"><button class="btn btn-danger btn-sm m-1" style="border-radius:50%;"><i class="fas fa-trash"></i></button></a>';
                return $btn;
            })
            ->rawColumns(['gambar', 'produk', 'aksi'])
            ->make(true);
    }

    public function pengujian_ik_pemeriksaan_create()
    {
        $dp = DetailProduk::all();
        return view('page.qc.pengujian_ik_pemeriksaan_create', ['dp' => $dp]);
    }

    public function pengujian_ik_pemeriksaan_store(Request $request)
    {
        $bool = true;
        for ($i = 0; $i < count($request->hal_yang_diperiksa); $i++) {
            $c = IkPemeriksaanPengujian::create([
                'detail_produk_id' => $request->detail_produk_id,
                'hal_yang_diperiksa' => $request->hal_yang_diperiksa[$i]
            ]);

            if ($c) {
                echo $c->id;
                for ($j = 0; $j < count($request->standar_keberterimaan[$i]); $j++) {
                    $cs = HasilIkPemeriksaanPengujian::create([
                        'ik_pemeriksaan_id' => $c->id,
                        'standar_keberterimaan' => $request->standar_keberterimaan[$i][$j]
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
            return redirect()->back()->with('success', "Berhasil menambahkan Pengujian");
        } else if ($bool == false) {
            return redirect()->back()->with('error', "Gagal menambahkan Pengujian");
        }
    }

    public function pengujian_ik_pemeriksaan_detail($id)
    {
        $s = IkPemeriksaanPengujian::where('detail_produk_id', $id)->get();
        $sp = DetailProduk::find($id);
        return view('page.qc.pengujian_ik_pemeriksaan_detail_show', ['id' => $id, 's' => $s, 'sp' => $sp]);
    }

    public function pengujian_ik_pemeriksaan_hasil_edit($id)
    {
        $s = IkPemeriksaanPengujian::find($id);
        return view('page.qc.pengujian_ik_pemersikaan_detail_edit', ['id' => $id, 's' => $s]);
    }

    public function pengujian_ik_pemeriksaan_hasil_create($id)
    {
        return view('page.qc.pengujian_ik_pemeriksaan');
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
