@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kartu Stok</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Kartu Stok</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="detail_produk_id" class="col-sm-5 col-form-label" style="text-align:right;">Tampilan</label>
                                <div class="col-sm-2 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="tampilan1" name="tampilan" value="hari_ini">
                                        <label for="tampilan1">
                                            Tampilkan Hari Ini
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-form-label">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="tampilan2" name="tampilan" value="produk">
                                        <label for="tampilan2">
                                            Tampilkan Per Produk
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="produk" class="col-sm-5 col-form-label" style="text-align:right;">Pilih Produk</label>
                                <div class="col-sm-4">
                                    <div class="select2-info">
                                        <select class="select2 custom-select form-control @error('produk') is-invalid @enderror produk" data-placeholder="Pilih Produk" data-dropdown-css-class="select2-info" style="width: 80%;" name="produk" id="produk" disabled>
                                            <option value=""></option>
                                            @foreach($p as $i)
                                            <option value="{{$i->id}}">{{$i->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="produktable" hidden>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="tanggal_daftar" class="col-sm-5 col-form-label" style="text-align:left;">Nomor Kartu</label>
                            <span class="col-sm-7 col-form-label" style="text-align:right;" id="no_kartu">-</span>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_permintaan_selesai" class="col-sm-5 col-form-label" style="text-align:left;">Nama Produk</label>
                            <span class="col-sm-7 col-form-label" style="text-align:right;" id="nama_produk">-</span>
                        </div>
                        <div class="form-group row" id="kartu_stock_tambah" hidden>
                            <label for="tambah" class="col-sm-5 col-form-label" style="text-align:left;">Tambahkan </label>
                            <span class="col-sm-7"><a class="tambahurl" href="/kartu_stock_gbj/create/"><button class="btn btn-success btn-sm btn-rounded col-form-label float-right" id="tambah" name="tambah">Tambah Kartu Stok</button></a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Jumlah Saldo</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;" id="tbodies">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="hariinitable" hidden>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>No Kartu</th>
                                        <th>Produk</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Jumlah Saldo</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;" id="tbodies">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('input[type="radio"][name="tampilan"]').on('change', function() {
            console.log($(this).val());
            if ($(this).val() == "hari_ini") {
                $('#produk').attr('disabled', true);
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                var yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                $('select[name="produk"]').select2('val', '');
                $('#hariinitable').removeAttr('hidden');
                $('#produktable').attr('hidden', true);
                $('#example1').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: false,
                    ajax: "/kartu_stock_gbj/tanggal/show/" + today,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        }, {
                            data: 'nomor',
                            name: 'nomor'
                        },
                        {
                            data: 'produk',
                            name: 'produk'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk'
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar'
                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo'
                        },
                    ]
                });
            } else if ($(this).val() == "produk") {
                $('#hariinitable').attr('hidden', true);
                $('#produktable').removeAttr('hidden');
                $('#produk').removeAttr('disabled');
            }
        });

        $('select[name="produk"]').on('change', function() {
            var k = $(this).val();
            if (k) {
                $.ajax({
                    url: '/kartu_stock_gbj/produk/' + k,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data != null) {
                            $("#no_kartu").text(data['nomor']);
                            $("#nama_produk").text(data['detail_produk']['nama']);
                            $("#kartu_stock_tambah").attr('hidden', true);
                        } else {
                            var newurl = '/kartu_stock_gbj/create/' + k;
                            v
                            $(".tambahurl").setAttribute('href', newurl)
                            $("#no_kartu").text("-");
                            $("#nama_produk").text("-");
                            $("#kartu_stock_tambah").removeAttr('hidden');

                        }
                    },
                    error: function(data) {
                        $("#no_kartu").text("-");
                        $("#nama_produk").text("-");
                        $("#kartu_stock_tambah").removeAttr('hidden');
                    }
                });

                $('#example2').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: "/kartu_stock_gbj/produk/show/" + k,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        }, {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'keterangan',
                            name: 'keterangan'
                        },
                        {
                            data: 'jumlah_masuk',
                            name: 'jumlah_masuk'
                        },
                        {
                            data: 'jumlah_keluar',
                            name: 'jumlah_keluar'
                        },
                        {
                            data: 'jumlah_saldo',
                            name: 'jumlah_saldo'
                        },
                    ]
                });
            }
        });
    });
</script>
@stop