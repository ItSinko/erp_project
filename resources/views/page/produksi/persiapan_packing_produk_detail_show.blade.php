<section class="content">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4>Info</h4><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($s->tanggal_bppb))}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Jumlah</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->jumlah}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4>Monitoring Proses</h4><br>
                    <table id="detaildata" class="table table-hover table-bordered styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Dokumen</th>
                                <th rowspan="2">Ketersediaan</th>
                                <th rowspan="2">Keterangan</th>
                                <th colspan="4">Spesifikasi & Ukuran</th>
                                <th rowspan="2">Verifikasi</th>
                            </tr>
                            <tr>
                                <th>Ukuran</th>
                                <th>Model</th>
                                <th>Warna Kertas</th>
                                <th>Warna Tinta</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>