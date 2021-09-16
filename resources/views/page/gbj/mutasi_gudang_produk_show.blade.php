<section class="content">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="tanggal_daftar" class="col-sm-5 col-form-label" style="text-align:left;">Tipe Produk</label>
                        <span class="col-sm-7 col-form-label" style="text-align:right;" id="tipe_produk">{{$gp->GudangProduk->DetailProduk->nama}}</span>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_permintaan_selesai" class="col-sm-5 col-form-label" style="text-align:left;">Nama Produk</label>
                        <span class="col-sm-7 col-form-label" style="text-align:right;" id="nama_produk">{{$gp->GudangProduk->DetailProduk->Produk->nama}}</span>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_permintaan_selesai" class="col-sm-5 col-form-label" style="text-align:left;">Tanggal</label>
                        <span class="col-sm-7 col-form-label" style="text-align:right;" id="jenis_produk">{{date("d-m-Y", strtotime($gp->tanggal))}}</span>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_permintaan_selesai" class="col-sm-5 col-form-label" style="text-align:left;">Asal Tujuan</label>
                        <span class="col-sm-7 col-form-label" style="text-align:right;" id="jenis_produk">
                            @if($gp->jumlah_masuk != "0")
                            <i class="fas fa-arrow-circle-down" style="color:green;"></i>
                            @elseif($gp->jumlah_keluar != "0")
                            <i class="fas fa-arrow-circle-up" style="color:red;"></i>
                            @endif
                            {{$gp->Divisi->nama}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2>Histori Mutasi</h2>
                    <table id="detaildata" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Barcode</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>