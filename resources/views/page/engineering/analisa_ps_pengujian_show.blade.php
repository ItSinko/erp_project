<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2>Hasil Analisa</h2>
                    <table id="detaildata" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="text-align: right;">No Seri</td>
                                <th>{{str_replace("/", "", $s->HasilMonitoringProses->MonitoringProses->alias_barcode)}}{{$s->HasilMonitoringProses->no_barcode}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Analisa</td>
                                <th>{{$s->analisa}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Pengerjaan</td>
                                <th>{{$s->realisasi_pengerjaan}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Tindak Lanjut</td>
                                <th>{{$s->tindak_lanjut}}</th>
                            </tr>
                            <tr>
                                <td style="text-align: right;">Kebutuhan Part</td>
                                <th>@if(!empty($s->BillOfMaterial))
                                    {{$s->BillOfMaterial->implode('part_eng_id',', ')}}
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