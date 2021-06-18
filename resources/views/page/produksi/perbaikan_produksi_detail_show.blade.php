<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3>Laporan Perbaikan</h3>
                    <table id="detaildata" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <tbody>
                            <tr>
                                <td>No BPPB</td>
                                <th>{{$s->Bppb->no_bppb}}</th>
                            </tr>
                            <tr>
                                <td>Produk</td>
                                <th>{{$s->Bppb->DetailProduk->nama}}</th>
                            </tr>
                            <tr>
                                <td>Tanggal Perbaikan</td>
                                <th>{{$s->tanggal_pengerjaan}}</th>
                            </tr>
                            <tr>
                                <td>No Seri</td>
                                <th>
                                    @if($s->ketidaksesuaian_proses == "perakitan")
                                    {{$s->HasilPerakitan->implode('no_seri',', ')}}
                                    @elseif($s->ketidaksesuaian_proses == "pengujian")
                                    {{str_replace('/', '', $s->HasilMonitoringProses[0]['MonitoringProses']->alias_barcode)}}{{$s->HasilMonitoringProses[0]['no_barcode']}}
                                    @elseif($s->ketidaksesuaian_proses == "pengemasan")
                                    {{str_replace('/', '', $s->HasilMonitoringProses[0]['MonitoringProses']->alias_barcode)}}{{$s->HasilMonitoringProses[0]['no_barcode']}}
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Operator</td>
                                <th>{{$s->Karyawan->nama}}</th>
                            </tr>
                            <tr>
                                <td>Ketidaksesuaian Proses</td>
                                <th>{{ucfirst($s->ketidaksesuaian_proses)}}</th>
                            </tr>
                            <tr>
                                <td>Sebab Ketidaksesuaian</td>
                                <th>{{str_replace('_', ' ', ucfirst($s->sebab_ketidaksesuaian))}}</th>
                            </tr>
                            <tr>
                                <td>Kondisi Produk</td>
                                <th>{{$s->kondisi_produk}}</th>
                            </tr>
                            <tr>
                                <td>Analisa</td>
                                <th>{{$s->analisa}}</th>
                            </tr>
                            <tr>
                                <td>Realisasi Pengerjaan</td>
                                <th>{{$s->realisasi_pengerjaan}}</th>
                            </tr>
                            <tr>
                                <td>Part</td>
                                <th>@if(!empty($s->BillOfMaterial))
                                    {{$s->BillOfMaterial->implode('part_eng_id', ', ')}}
                                    @elseif(empty($s->BillOfMaterial))
                                    <span class="text-muted">Tidak ada</span>
                                    @endif
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>