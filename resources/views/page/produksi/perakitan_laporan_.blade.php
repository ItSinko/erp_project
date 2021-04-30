<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2>Laporan Perakitan</h2>
                    <table id="detaildata" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <tbody>
                            <tr>
                                <th>No BPPB</th>
                                <th>{{$s->Perakitan->Bppb->no_bppb}}</th>
                            </tr>
                            <tr>
                                <th>Produk</th>
                                <th>{{$s->Perakitan->Bppb->DetailProduk->nama}}</th>
                            </tr>
                            <tr>
                                <th>Tanggal Perakitan</th>
                                <th>{{$s->tanggal}}</th>
                            </tr>
                            <tr>
                                <th>Operator</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>No Seri</th>
                                <th>{{$s->no_seri}}</th>
                            </tr>
                            <tr>
                                <th rowspan="5">Pemeriksaan Terbuka</th>
                                <th>Kondisi Bahan Baku</th>
                                <th>{{$s->kondisi_fisik_bahan_baku}}</th>
                            </tr>
                            <tr>
                                <th>Kondisi Proses Perakitan</th>
                                <th>{{$s->kondisi_se}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>